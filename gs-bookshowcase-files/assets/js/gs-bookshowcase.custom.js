// ----------- auto height fixing -----------
(function($){

    function fixButtonHeights() {
        var heights = new Array();

        // Loop to get all element heights
        $('.gs_book_theme1 .single-book img').each(function() {
            // Need to let sizes be whatever they want so no overflow on resize
            $(this).css('min-height', '0');
            $(this).css('max-height', 'none');
            $(this).css('height', 'auto');

            // Then add size (no units) to array
             heights.push($(this).height());
        });

        // Find max height of all elements
        var max = Math.max.apply( Math, heights );

        // Set all heights to max height
        $('.gs_book_theme1 .single-book img').each(function() {
            $(this).css('height', max + 'px');
            // Note: IF box-sizing is border-box, would need to manually add border and padding to height (or tallest element will overflow by amount of vertical border + vertical padding)
        });
    }
})(jQuery);