var page = new WebPage(),
    url = 'http://google.pl',
    stepIndex = 0;

page.onConsoleMessage = function (msg, line, source) {
    console.log('console> ' + msg);
};
page.onAlert = function (msg) {
    console.log('alert!!> ' + msg);
};

// Callback is executed each time a page is loaded...
page.open(url, function (status) {
  if (status === 'success') {
    // State is initially empty. State is persisted between page loads and can be used for identifying which page we're on.
    console.log('============================================');
    console.log('Step "' + stepIndex + '"');
    console.log('============================================');

    // Inject jQuery for scraping (you need to save jquery-1.6.1.min.js in the same folder as this file)
    page.injectJs('jquery-1.6.1.js');

    // Our "event loop"
    if(!phantom.state){
      initialize();
    } else {
      phantom.state();
    } 

    // Save screenshot for debugging purposes
    page.render("step" + stepIndex++ + ".png");
  }
});

// Step 1
function initialize() {
  phantom.state = parseResults; 
}

// Step 2
function parseResults() {
  page.evaluate(function() {
    $('a').each(function(index, link) {
      console.log($(link).attr('href'));
    })
    console.log('Parsed results');
  });
  // If there was a 3rd step we could point to another function
  // but we would have to reload the page for the callback to be called again
  phantom.exit(); 