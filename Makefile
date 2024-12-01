# Variables
PHP_ARTISAN = php artisan
COMPOSER = composer

# Default target: install everything
install: clone-env composer-install install-livewire generate-key migrate storage-link queue-work npm-run serve

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

# Step 7: Run queue worker
queue-work:
	$(PHP_ARTISAN) queue:work

# Step 8: Run npm
npm-run:
	npm run dev

# Step 9: Serve the application
serve:
	$(PHP_ARTISAN) serve
