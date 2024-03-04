## OSRS Loot Simulator Discord Bot

This is a Discord bot that simulates loot from the game Old School RuneScape. It is written in PHP using the Laravel framework.
The loot generated is based on the drop tables and drop rates from the game, however the drop rates are not guaranteed to be
the same as the actual game.

The purpose of this discord bot is to provide a fun way for players to simulate loot from the game, merely for entertainment purposes.
I do not own any of the content from the game, and this bot is not affiliated with Jagex Ltd.

## Adding the bot to your server
To add my hosted bot to your server, click [here](https://discord.com/api/oauth2/authorize?client_id=1205972225853890610&permissions=0&scope=bot)
In the case that the bot is no longer hosted, you can host the bot yourself by following the instructions below.

## Usage
This bot uses Discord slash commands to generate loot.
To use the bot, type `/loot` in a channel where the bot is present. Fill in the target and quantity options and hit Enter.
The bot will receive the request and display a "Loading..." message while it generates the loot. Once the loot is generated, 
the bot will edit the original message with the loot picture.

## Local Development

### Prerequisites
- Docker
- Git

### Setup
1. Clone the repository, cd into the directory
2. Run `composer install` to install the dependencies
3. Run `cp .env.example .env` to create a .env file, adjust as needed
4. Run `./vendor/bin/sail up -d` to create containers and start the development environment

## Deployment

I recommend using [Laravel Forge](https://forge.laravel.com/) to deploy this bot to a server. It is a simple and easy way to deploy Laravel applications.

1. Create a discord application and bot, and then generate a token for the bot.
   - See the Laravel Discord Bot Repo for more information on how to set up a Discord bot: https://github.com/nwilging/laravel-discord-bot
2. Link a domain to the server so that you can generate an interactions URL for the Discord application.
   - Discord requires SSL for the interactions URL, so you'll need to set up SSL on the server.
3. Set up the site on Forge, and then deploy the code to the server, updating the .env file with the Discord bot information

## Example Loot Generations
![1000 Theatre of Blood](https://i.imgur.com/0veRIFO.png)
![500 Kree'arra](https://i.imgur.com/rh3xFMA.png)
![10 Artio](https://i.imgur.com/pDuo74N.png)
