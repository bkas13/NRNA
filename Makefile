docker-build:
	docker build -t registry.ybcsystems.com/ybcteam/nrna-monolith .

up:
	docker compose up -d --remove-orphans

down:
	docker compose down --remove-orphans