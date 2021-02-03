# Last commit
Get last commit from repository on a passed branch via CLI tool. Currently, supports only Github.com platform.

## Installation
Clone repository
```bash
$ git clone git@github.com:plumthedev/last-commit.git last-commit
```

Make `.env` file
```bash
$ cp .env.example .env
```

Install dependencies 
```bash
$ composer install
```

Generate application key
```bash
$ php artisan key:generate --ansi
```

## Usage
Get last commit from repository on a branch.

```bash
$ php artisan last-commit:sha <repository-name> <branch-name> [--service=github]
```

```bash
$ php artisan last-commit:sha plumthedev/last-commit master
```

## Architecture
All magic happens in `app/Services/LastCommit`. 
I assumed that every service like Github, BitBucket or whatever is a platform. 

Every platform has repositories which is the smallest basic part in system on this moment. 
Repositories can have branches, commits and code, also this is not conflict with developing system in a feature (e.g. users module).

To repository in a constructor is injected platform client which uses a http client to make platform API requests. 
Http client has base API url sets on initialize.

To make decisions about a used platform I used strategy pattern.

All of this make this system super extendable and easy to maintenance - written with SOLID rules and love to code :) 
