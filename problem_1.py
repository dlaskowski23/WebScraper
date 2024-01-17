import requests
from bs4 import BeautifulSoup
from pymongo import MongoClient
import time

client = MongoClient('mongodb://localhost:27017/')
db = client['stock_database']
collection = db['most_active_stocks']


url = "https://finance.yahoo.com/most-active"

while True:
    response = requests.get(url)
    if response.status_code == 200:
        collection.delete_many({})
        soup = BeautifulSoup(response.text, 'html.parser')
        rows = soup.find_all('tr', attrs={'class': 'simpTblRow'})

        for row in rows:
            symbol = row.find('a', class_='Fw(600)').text
            name = row.find('td', class_='Va(m) Ta(start) Px(10px) Fz(s)').text
            price = row.find('fin-streamer', attrs={'data-field': 'regularMarketPrice'}).text
            change = row.find('fin-streamer', attrs={'data-field': 'regularMarketChange'}).text
            volume = row.find('fin-streamer', attrs={'data-field': 'regularMarketVolume'}).text

                
            collection.insert_one({
                'Symbol': symbol,
                'Name': name,
                'Price (Introday)': price,
                'Change': change,
                'Volume': volume
            })

        time.sleep(180)
    else:
        print('Page wait to load. Retrying.')
        time.sleep(10)