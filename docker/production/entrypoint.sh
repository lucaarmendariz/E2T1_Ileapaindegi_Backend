#!/bin/bash

echo "Starting Laravel Production Container..."

# Esperar a que la base de datos esté lista
echo "Waiting for database..."
until php artisan db:show 2>/dev/null; do
    echo "Database is unavailable - sleeping"
    sleep 2
done

echo "Database is ready!"

# Ejecutar migraciones si está habilitado
if [ "$RUN_MIGRATIONS" = "true" ]; then
    echo "Running migrations..."
    php artisan migrate --force --no-interaction
fi

# Limpiar y cachear configuraciones
echo "Optimizing Laravel..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Iniciar servidor Laravel
echo "Starting Laravel server..."
exec php artisan serve --host=0.0.0.0 --port=8000