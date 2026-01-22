#!/bin/sh
# ===========================================
# Sync public files from Docker image to host
# This ensures new images added to the image are available on the host
# ===========================================

set -e

SOURCE_DIR="/var/www/html/public"
HOST_DIR="${HOST_PUBLIC_DIR:-/var/www/nemo-tours-dev/public}"

echo "🔄 Syncing public files from container to host..."

# Create destination directory if it doesn't exist
mkdir -p "$HOST_DIR"

# Sync landing-page assets (images, CSS, JS)
if [ -d "$SOURCE_DIR/landing-page" ]; then
    echo "📁 Syncing landing-page assets..."
    rsync -av --delete \
        "$SOURCE_DIR/landing-page/assets/" \
        "$HOST_DIR/landing-page/assets/" || {
        # Fallback to cp if rsync is not available
        echo "⚠️  rsync not available, using cp..."
        mkdir -p "$HOST_DIR/landing-page/assets"
        cp -r "$SOURCE_DIR/landing-page/assets/." "$HOST_DIR/landing-page/assets/" || true
    }
fi

# Sync other public static files (CSS, JS, images)
echo "📁 Syncing other public static files..."
rsync -av --delete \
    --include="*.css" \
    --include="*.js" \
    --include="*.png" \
    --include="*.jpg" \
    --include="*.jpeg" \
    --include="*.gif" \
    --include="*.svg" \
    --include="*.ico" \
    --include="*.woff" \
    --include="*.woff2" \
    --include="*.ttf" \
    --include="*.eot" \
    --exclude="*" \
    "$SOURCE_DIR/" \
    "$HOST_DIR/" || {
    echo "⚠️  rsync failed, trying cp..."
    # Fallback: copy specific directories
    for dir in css js img images fonts; do
        if [ -d "$SOURCE_DIR/$dir" ]; then
            mkdir -p "$HOST_DIR/$dir"
            cp -r "$SOURCE_DIR/$dir/." "$HOST_DIR/$dir/" || true
        fi
    done
}

# Set proper permissions
chown -R www-data:www-data "$HOST_DIR" 2>/dev/null || true
chmod -R 755 "$HOST_DIR" 2>/dev/null || true

echo "✅ Public files synced successfully!"

# Execute the original command
exec "$@"
