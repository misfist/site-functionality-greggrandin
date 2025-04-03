from bs4 import BeautifulSoup
import datetime

html_content = """
<div class="entry-content alignfull wp-block-post-content has-global-padding is-layout-constrained wp-block-post-content-is-layout-constrained">
<p>“<a href="http://www.nytimes.com/2014/01/19/opinion/sunday/obama-melville-and-the-tea-party.html" target="_blank" rel="noreferrer noopener external" data-wpel-link="external">Obama, Melville and the Tea Party </a>,”<em> New York Times Sunday Review</em>, January 18, 2014</p>
<p>“<a href="http://www.thenation.com/article/177825/reading-melville-post-911-america" target="_blank" rel="noreferrer noopener external" data-wpel-link="external">Reading Melville in Post 9/11 America </a>,” <em>The Nation</em>, January 27, 2014</p>
<p>“<a href="http://chronicle.com/article/Slavery-in-FactFiction/143551/" target="_blank" rel="noreferrer noopener external" data-wpel-link="external">Who Ain’t a Slave: Historical Fact and the Fiction of ‘Benito Cereno,’” </a> <em>Chronicle of Higher Education</em>, December 16, 2013</p>
<p>“<a href="http://www.tomdispatch.com/post/175798/tomgram%3A_greg_grandin,_the_terror_of_our_age/" target="_blank" rel="noreferrer noopener external" data-wpel-link="external">The Terror of Our Age </a>,” <a href="http://www.tomdispatch.com/post/175798/tomgram%3A_greg_grandin,_the_terror_of_our_age/" target="_blank" rel="noreferrer noopener external" data-wpel-link="external">Tomdispatch.com </a>, January 26, 2014</p>
</div>
"""

soup = BeautifulSoup(html_content, 'html.parser')

articles = []
for p_tag in soup.find_all('p'):
    # Extract Title and Link
    title_link_tag = p_tag.find('a')
    if title_link_tag:
        title = title_link_tag.text.strip()
        title_link = title_link_tag['href']
    else:
        continue

    # Extract Source and Source Link
    source_tag = p_tag.find('em')
    source = source_tag.text.strip() if source_tag else 'Unknown Source'

    # Check for a second <a> tag for the source link
    source_link_tag = p_tag.find_all('a')[1] if len(p_tag.find_all('a')) > 1 else None
    source_link = source_link_tag['href'] if source_link_tag else None

    # Extract the date from the text after the last comma
    text_parts = p_tag.text.split(',')
    
    # Assuming the last part contains the date (e.g., "January 18, 2014")
    if len(text_parts) > 1:
        date_text = text_parts[-1].strip()  # Get the last part (the date)
        print(f"Found: {date_text}")  # Debugging print

        try:
            # Try parsing the date in "Month Day, Year" format
            date = datetime.datetime.strptime(date_text, '%B %d, %Y').date()
            # Format the date as YYYY-MM-DD
            formatted_date = date.strftime('%Y-%m-%d')
        except ValueError:
            # If parsing fails, we can handle it as None
            formatted_date = None
    else:
        formatted_date = None

    articles.append({
        'title': title,
        'title_link': title_link,
        'source': source,
        'source_link': source_link,
        'date': formatted_date
    })

# Print the extracted data
for article in articles:
    print(f"Title: {article['title']}")
    print(f"Title Link: {article['title_link']}")
    print(f"Source: {article['source']}")
    print(f"Source Link: {article['source_link']}")
    print(f"Date: {article['date']}")
    print('---')
