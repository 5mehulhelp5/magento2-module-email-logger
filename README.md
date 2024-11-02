# EmailLogger Module for Magento 2

## Overview
The **EmailLogger** module is designed to log all outgoing emails from your Magento 2 store. This can be useful for debugging purposes, auditing email communication, and ensuring that emails are sent as expected.

## Features
- Logs all outgoing emails from the site.
- Stores relevant email data such as subject, recipient, and timestamp.
- Easy installation and configuration.

## Installation

### Step 1: Create Module Directory
1. Create the directory structure for the module:
   ```
   app/code/Hryvinskyi/EmailLogger
   ```

### Step 2: Copy Module Files
2. Copy all module files into the `app/code/Hryvinskyi/EmailLogger` directory.

### Step 3: Enable the Module
3. Run the following commands to enable the module:
   ```
   bin/magento module:enable Hryvinskyi_EmailLogger
   bin/magento setup:upgrade
   bin/magento cache:flush
   ```

## Configuration
To configure the module, follow these steps:

1. Go to **Stores > Configuration > Hryvinskyi > EmailLogger**.
2. Enable or disable logging as needed.
3. Customize the log retention period if desired.

## Usage
After the module is installed and enabled, all outgoing emails will be logged. You can find the log entries in the database table named `email_logger` or view them in the Magento admin panel under **Reports > Email Logs**.

## Support
If you encounter any issues or need assistance, please feel free to open an issue on our repository or contact our support team.

## License
This module is licensed under the MIT License. See the [LICENSE](LICENSE) file for more details.

## Authors
- [Your Name] - Developer of the EmailLogger Module
