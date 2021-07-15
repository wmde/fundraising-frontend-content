BUILD_DIR     := $(PWD)

setup: install

install:
	docker run -v $(BUILD_DIR):/app -w /app composer install

update:
	docker run -v $(BUILD_DIR):/app -w /app composer update

ci:
	docker run -v $(BUILD_DIR):/app -w /app composer ci

test:
	docker run -v $(BUILD_DIR):/app -w /app composer test

.PHONY: setup test ci install update
