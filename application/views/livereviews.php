<h1><?=${DATA_BODY}[ARTICLE_TITLE]?></h1>
<p>This page provides an example of the <a href="http://docs.livefyre.com/developers/reference/app-types/reviews/" target="_blank">Live Reviews</a> app, which is part of StreamHub Core.</p>

<div id="livefyre">Coming soon!</div>

        <style type='text/css'>
            .fyre-reviews .fyre-editor {
                margin: 24px 0 10px 0 !important;
            }
            .fyre .fyre-editor-ratings {
                position: relative !important;
                top: -6px !important;
            }
            .fyre .fyre-editor-ratings button,
            .fyre .fyre-reviews-rating-wrapper span {
                background-color: #F5FF00;
                border: 1px dotted #666;
                color: #000;
                cursor: pointer;
                display: inline-block;
                margin-right: 8px;
                padding: 3px 6px;
            }
            .fyre .fyre-reviews-rating-wrapper span strong {
                margin-right: 4px;
            }
            .fyre .fyre-editor-ratings > div {
                float: left;
                width: 50%;
            }
            .fyre .fyre-editor-ratings > div > h3 {
                float: left;
                font-family: "Helvetica Neue", Arial, Helvetica, Geneva, sans-serif;
                font-size: 14px;
                margin: 0;
                padding: 0;
                width: 95px;
            }
            .fyre .fyre-editor-ratings > div:nth-child(1) > h3,
            .fyre .fyre-editor-ratings > div:nth-child(3) > h3 {
                width: 60px;
            }
            .fyre .fyre-editor-ratings button.selected {
                background-color: #00f;
                border: 1px dotted #666;
                color: #fff;
            }
            .fyre .fyre-editor-ratings button.invalid {
                background-color: #f00;
                border: 1px dotted #666;
                color: #fff;
            }
            .fyre .fyre-editor-container {
                clear: both;
            }
        </style>
<script type="text/javascript">

/**
 * Rating dimensions that we'll use for our delegates.
 * @type {Array.<string>}
 */
var ratingDimensions = [
    'Overall',
    'Design',
    'Features',
    'Performance'
];

/**
 * Rating display delegate. This doesn't need to be a function because
 * it only does one thing and doesn't need instance variables.
 * @constructor
 */
var ratingDisplayDelegate = function() {};
/**
 * Renders a rating onto the provided element. This decorates the first
 * argument with the data provided.
 * @param {Element} elem The element to be decorated.
 * @param {Object} data Data containing the rating.
 */
ratingDisplayDelegate.prototype.renderRating = function(elem, data) {
	 
    var dim;
    var ratingElem;
    var ratingLabel;
    // Loop through all rating dimensions and create DOM elements for
    // each and append to the element being decorated.
    for (var i = 0; i < ratingDimensions.length; i++) {
        dim = ratingDimensions[i];
        ratingElem = document.createElement('span');
        ratingLabel = document.createElement('strong');
        ratingLabel.innerHTML = dim + ':';
        ratingElem.appendChild(ratingLabel);
        ratingElem.appendChild(document.createTextNode(data.rating[dim]));
        elem.appendChild(ratingElem);
    }
};

/**
 * @constructor
 * @implements {fyre.v2.editor.delegates.RatingInterface}
 * @param {number} maxRating The max rating that can be given.
 * @param {boolean} halfRatingEnabled Whether the review uses half
 *    ratings or not.
 */
var ratingSelectionDelegate = function(maxRating, halfRatingEnabled) {
    this.maxRating_ = maxRating;
    this.halfRatingEnabled_ = halfRatingEnabled;

    /**
     * Container for the selected ratings.
     * @type {Object}
     */
    this.selectedRatings = {};
};

/** @enum {string} */
ratingSelectionDelegate.CLASSES = {
    SELECTED: 'selected',
    INVALID: 'invalid'
};

/**
 * Builds an individual rating selector element.
 * @param {string} dim The dimension of this selector.
 * @return {Element} The selector element.
 */
ratingSelectionDelegate.prototype.buildRatingSelector = function(dim) {
    var container = document.createElement('div');
    container.setAttribute('data-dimension', dim);
    var ratingElem;
    var ratingInterval = 100/this.maxRating_;
    for (var i=0; i<this.maxRating_; i++) {
        ratingElem = document.createElement('button');
        ratingElem.value = ratingInterval * (i+1);
        ratingElem.innerHTML = i+1;
        container.appendChild(ratingElem);
    }
    return container;
};

/**
 * Get the rating value that the user selected. This should validate
 * the input before returning it to ensure that the data is correct. If
 * invalid, should show errors to the user.
 * @return {Object} Object containing the user's rating.
 */
ratingSelectionDelegate.prototype.getRating = function() {
    if (!this.validateRatings()) {
        return;
    }
    return this.selectedRatings;
};

/**
 * Show the rating element so that a user can rate it.
 * @param {Element} element The element to be decorated.
 */
ratingSelectionDelegate.prototype.showRatingSelector = function(elem) {
    this.elem_ = elem;
    var ratingContainer;
    var dimensionTitle;
    var dim;
    // Loop through the rating dimensions and create a rating selector
    // for each. Append them to the element that we want to decorate.
    for (var i = 0; i < ratingDimensions.length; i++) {
        dim = ratingDimensions[i];
        ratingContainer = document.createElement('div');
        dimensionTitle = document.createElement('h3');
        dimensionTitle.innerHTML = dim;
        ratingContainer.appendChild(dimensionTitle);
        ratingContainer.appendChild(this.buildRatingSelector(dim));
        elem.appendChild(ratingContainer);
    }

    var that = this;
    // Attaching a click event handler to the buttons so that we can
    // keep track of the ratings that the user selected.
    $(elem).on('click', 'button', function(ev) {
        var CLASSES = ratingSelectionDelegate.CLASSES;
        var selected = $(this);
        var dim = selected.parent().attr('data-dimension');
        that.selectedRatings[dim] = parseInt(selected.val(), 10);
        var dimEl = $('div[data-dimension='+ dim +']', elem);
        // Remove all selected and invalid classes on the current
        // dimension buttons.
        $('button', dimEl).removeClass(CLASSES.SELECTED)
            .removeClass(CLASSES.INVALID);
        selected.addClass(CLASSES.SELECTED);
    });
};

/**
 * Validate the ratings so that we don't submit empty ones.
 * @return {boolean} Whether the ratings are valid.
 */
ratingSelectionDelegate.prototype.validateRatings = function() {
    var CLASSES = ratingSelectionDelegate.CLASSES;
    var dim;
    var valid = true;
    for (var i = 0; i < ratingDimensions.length; i++) {
        dim = ratingDimensions[i];
        if (!this.selectedRatings[dim]) {
            valid = false;
            var dimEl = $('div[data-dimension='+ dim +']', this.elem_);
            dimEl.find('button').addClass(CLASSES.INVALID);
        }
    }
    return valid;
};

/**
 * Rating summary delegate. This is used to render a summary view of
 * the rating data into a nice visual format.
 * @constructor
 * @param {number} maxRating
 */
var ratingSummaryDelegate = function(maxRating) {
    this.maxRating_ = maxRating;
};

/**
 * Decorate the summary view. This takes an element and data as
 * arguments and uses them to modify the summary element to show
 * the rating.
 * @param {Element} elem The element to decorate.
 * @param {Object} data The data required to render this view.
 */
ratingSummaryDelegate.prototype.renderSummary = function(elem, data) {

};

var lfepAuthDelegate = new fyre.conv.SPAuthDelegate({engage: {app: "client-solutions.auth.fyre.co"}});

var networkConfig = {
	network: '<?=LIVEFYRE_NETWORK?>',
	authDelegate: lfepAuthDelegate
}

networkConfig["strings"] = {
        ratingSubpartPlaceholders: ['Pros...', 'Cons...'],
        ratingSubpartTitles: ['Pros: ', 'Cons: '],
        ratingSubpartIds: ['pros', 'cons'],
        reviewStreamTitle: 'Description: ',
}

var convConfig = {
	siteId: '<?=LIVEFYRE_SITE_ID?>',
	articleId: '<?=${DATA_BODY}[ARTICLE_ID]?>',
	el: 'livefyre',
	app: 'reviews',
	ratingSummaryEnabled: true,
	ratingSubparts:2,
    ratingDimensions: ['design', 'features', 'performance'],
	// Delegates
    ratingSelectionDelegate: ratingSelectionDelegate,
    ratingDisplayDelegate: ratingDisplayDelegate,
    ratingSummaryDelegate: ratingSummaryDelegate,
    
    maxRating: 5,
	collectionMeta: '<?=${DATA_BODY}[COLLECTION_META]?>', 
	checksum: '<?=${DATA_BODY}[CHECKSUM]?>'
}

fyre.conv.load( networkConfig, [convConfig] );

</script>
