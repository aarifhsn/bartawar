# Variables
PHP_ARTISAN = php artisan
COMPOSER = composer

# Default target: install everything
install: clone-env composer-install install-livewire generate-key migrate storage-link serve

# Step 1: Clone environment file
clone-env:
	cp .env.example .env

# Step 2: Install composer dependencies
composer-install:
	$(COMPOSER) install

# Step 3: Install Livewire
install-livewire:
	$(COMPOSER) require livewire/livewire

# Step 4: Generate application key
generate-key:
	$(PHP_ARTISAN) key:generate

# Step 5: Run database migrations
migrate:
	$(PHP_ARTISAN) migrate

# Step 6: Create symbolic link for storage
storage-link:
	$(PHP_ARTISAN) storage:link

# Step 7: Serve the application
serve:
	$(PHP_ARTISAN) serve
