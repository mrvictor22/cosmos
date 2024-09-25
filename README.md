# cosmos
# Cosmos Backend

This is the backend portion of the Cosmos project. It includes features like extracting data from an API, transforming JSON data into CSV, encrypting and uploading files to SFTP, and saving data to a MySQL database using Doctrine ORM.

## Requirements

- PHP 8.0 or higher
- Symfony 5.3 or higher
- Composer
- MySQL
- OpenSSL
- phpseclib3 (for SFTP)
- Doctrine ORM

## Installation

1. Clone the repository:
    ```bash
    git clone https://github.com/mrvictor22/cosmos.git
    cd cosmos
    ```

2. Install dependencies:
    ```bash
    composer install
    ```

3. Set up environment variables in the `.env` file:
    ```dotenv
    APP_ENV=dev
    DATABASE_URL=mysql://user:password@127.0.0.1:3306/database_name
    SFTP_HOST=sftp.example.com
    SFTP_USER=username
    SFTP_PRIVATE_KEY=/path/to/private_key.ppk
    ENCRYPTION_KEY=your_encryption_key
    ```

4. Set up the database:
    Use the sql file in the repo

## Commands

### 1. Extract Data Command
This command fetches user data from an external API and saves it as a JSON file.

Usage:
```bash
php bin/console app:extract-data
```
2. Transform Data Command
This command converts the extracted JSON data into a CSV file.

Usage:

```
php bin/console app:transform-data
```
3. Upload to SFTP Command
This command encrypts and uploads the CSV and JSON files to an SFTP server.

Usage:

```
php bin/console app:upload-to-sftp
```
4. Save Data to Database
This command reads from the CSV and JSON files and saves the data into the summary and detail tables in the database.

Usage:

```
php bin/console app:create-summary
```