# cis-test

This is a child-theme from Astra

After cloning:
- Make sure you have node & npm installed
- run: npm install
- compile & watch every vue/js change from resources/js/index.js run: npm run dev

To accomplish this test:
  - Get a fresh install of WordPress
  - You will need to install Astra theme in order to work with this theme
  - Clone this repo and follow up the above "After cloning" steps
  - Create a new branch with this structure "your_name-starting_date"
  - Create a new page inside of WordPress called Dashboard and make it the homepage itself
  - Create a new Custom Post Type called Events
  - Using the new CPT, create 5-10 events with dummy content (title, content, feature image)
  - Using WordPress REST API function create a new endpoint to get all Events with their info (your new CPT)
  - There is Vue component in resources/js/App.vue, from this component make a fetch to your endpoint to get all events
  - After getting the events use the same html vue template section to render the events with this structure (https://prnt.sc/s6RIUEGHpvHI)
  - Make each card clickable to redirect to its single page (Design of this page is not needed just the redirect)

Event Grid Structure reference from https://www.eventbrite.es/
