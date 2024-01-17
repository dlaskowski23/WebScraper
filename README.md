# Web Scraping Project: Most Active Stocks Data

## Project Description

This project is a simple web scraping application that fetches real-time data about the most active stocks from Yahoo Finance and displays it on a web page. It uses Python for scraping the data and PHP for displaying it.

## Components

1. **Python Script (`problem_1.py`):** Scrapes data from Yahoo Finance's "Most Active" stocks page. The script uses `requests` for HTTP requests, `BeautifulSoup` for parsing HTML, and `pymongo` for interacting with MongoDB.

2. **PHP Script (`myphp.php`):** Retrieves the scraped data from MongoDB and displays it on a web page. It includes functionalities for sorting the data in the table.

## Setup and Installation

### Prerequisites

- Python 3.x
- PHP 7.x or above
- MongoDB
- Required Python libraries: `requests`, `bs4` (BeautifulSoup), `pymongo`

### Running the Application

1. **Start MongoDB:** Ensure MongoDB is running on your local machine.

2. **Run the Python Script:**
   - Install the required Python libraries.
   - Execute the script `problem_1.py` to start scraping the data.

3. **Display the Data:**
   - Host the PHP script `myphp.php` on a local or web server.
   - Access the PHP page through your browser to view the most active stocks data.

## Features

- **Data Scraping:** Real-time scraping of stock data from Yahoo Finance.
- **Data Storage:** Storing scraped data in MongoDB for retrieval.
- **Web Interface:** A simple and interactive web interface to display the stock data with sorting functionality.

## Contributing

Feel free to fork this project and contribute. Any contributions you make are greatly appreciated.
