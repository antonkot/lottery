# CASEXE PHP test

The lottery app. User can get one of the following: money, loyalty points or one thing from predefined list. Money can be sent to user's bank account or converted to the loyalty points. The thing can be sent via regular mail. User can refuse his gift.

## Installation

1. Install [Docker](https://docs.docker.com/install/linux/docker-ce/ubuntu/) with docker-compose
2. Clone this repo
3. In terminal run
```
docker-compose run --rm backend composer install
docker-compose run --rm backend /app/init
```
4. Run the migrations
```
docker-compose run --rm backend yii migrate
```
5. Start container
```
docker-compose up -d
```

6. Access in browser:
* frontend: http://127.0.0.1:20080
* backend: http://127.0.0.1:21080

## Roadmap

- [x] Install and configure Yii framework
- [x] Make migrations for User, Lottery, Gift and Thing models
- [x] Make CRUD for models
- [x] Make lottery front logic
- [x] Make console command for sending money in batch of N transactions
- [ ] Make Unit-test for convertation from money to loyalty points
- [ ] Cleanup
