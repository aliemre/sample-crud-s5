$(document).ready(function() {
    // Summernote
    $('.summernote').summernote();

    // Tags
    $('.tags-input').tagsinput({
        confirmKeys: [13, 44],
        // maxTags: 1,
        typeahead: {
            source: function(query) {
                return $.get('/tags/search?q=' + query);
            }
        }
    });
    $('.tags-input').on('itemAdded', function(event) {
        setTimeout(function(){
            $(">input[type=text]",".bootstrap-tagsinput").val("");
        }, 1);
    });
});