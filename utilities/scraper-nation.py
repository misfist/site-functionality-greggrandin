import requests
from bs4 import BeautifulSoup
import csv
import time
import warnings
warnings.filterwarnings("ignore", category=UserWarning, module="urllib3")

# Base URL of the author's page
base_url = "https://www.thenation.com/authors/greg-grandin/"
articles = []
filename = "nation.csv"

def scrape_page(url):
    response = requests.get(url)
    if response.status_code != 200:
        print(f"Failed to fetch {url}")
        return None

    soup = BeautifulSoup(response.text, "html.parser")
    
    # Find all article blocks
    for article in soup.select("div.collections__card"):
        title_tag = article.select_one("h2 a")
        date_tag = article.select_one("p.knockout span.collections__label")
        image_tag = article.select_one("img.collections__card-image")  # Get the image tag

        if title_tag and date_tag and image_tag:
            title = title_tag.text.strip()
            link = title_tag["href"]
            date = date_tag.text.strip()
            image_link = image_tag["src"]  # Extract the image URL

            print(f"Found: {title} | {date} | {link} | {image_link}")  # Debugging print

            articles.append([title, date, link, image_link])
    
    # Find next page link
    # next_page = soup.select_one("a.pagination-next")
    # return next_page["href"] if next_page else None
    next_page = soup.select_one("a.page-number.page-numbers:not(.current)")  # Skip 'current' page
    if next_page:
        next_page_url = next_page["href"]
        # Make sure to prepend the base URL if the next page URL is relative
        if not next_page_url.startswith("http"):
            next_page_url = f"https://www.thenation.com{next_page_url}"
        return next_page_url
    return None

# Scrape all pages
next_url = base_url
while next_url:
    print(f"Scraping: {next_url}")
    next_url = scrape_page(next_url)
    time.sleep(2)  # Be respectful, avoid excessive requests

# Save results to CSV
with open(filename, "w", newline="", encoding="utf-8") as file:
    writer = csv.writer(file)
    writer.writerow(["Title", "Date", "Link"])
    writer.writerows(articles)

print(f"Scraping complete! Data saved {filename}")
