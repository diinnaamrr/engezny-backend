#!/bin/sh
# ===========================================
# Sync public files from image to host on container startup
# This script runs before php-fpm starts
# ===========================================

set -e

HOST_PUBLIC_DIR="${HOST_PUBLIC_DIR:-/var/www/nemo-tours-dev/public}"
SOURCE_DIR="/var/www/html/public"

echo "🔄 Syncing public files from image to host..."

# Check if we can access host directory (mounted via volume)
if [ -d "$HOST_PUBLIC_DIR" ] || [ -w "/var/www/html/public" ]; then
    # Copy landing-page assets
    if [ -d "$SOURCE_DIR/landing-page/assets" ]; then
        echo "📁 Syncing landing-page assets..."
        mkdir -p "$HOST_PUBLIC_DIR/landing-page/assets"
        cp -rn "$SOURCE_DIR/landing-page/assets/." "$HOST_PUBLIC_DIR/landing-page/assets/" 2>/dev/null || true
    fi
    
    # Copy other static files
    echo "📁 Syncing other public files..."
    find "$SOURCE_DIR" -type f \( -name "*.css" -o -name "*.js" -o -name "*.png" -o -name "*.jpg" -o -name "*.jpeg" -o -name "*.gif" -o -name "*.svg" -o -name "*.ico" -o -name "*.woff" -o -name "*.woff2" \) -exec sh -c '
        dest="$HOST_PUBLIC_DIR/${1#$SOURCE_DIR/}"
        mkdir -p "$(dirname "$dest")"
        cp -n "$1" "$dest" 2>/dev/null || true
    ' _ {} \;
    
    echo "✅ Public files synced!"
else
    echo "⚠️  Cannot access host directory. Files will be available in container only."
fi

# Execute the original command
exec "$@"
