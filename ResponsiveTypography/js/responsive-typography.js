jQuery(document).ready(function($) {
    var ids = pagelines_responsive_typography.flowtype.ids;
    var classes = pagelines_responsive_typography.flowtype.classes;

    var options = new Object();
    options.minimum = parseInt(pagelines_responsive_typography.flowtype.minimum_width);
    options.maximum = parseInt(pagelines_responsive_typography.flowtype.maximum_width);
    options.minFont = parseInt(pagelines_responsive_typography.flowtype.minimum_font_size);
    options.maxFont = parseInt(pagelines_responsive_typography.flowtype.maximum_font_size);
    options.fontRatio = parseInt(pagelines_responsive_typography.flowtype.font_ratio);
    options.lineRatio = parseFloat(pagelines_responsive_typography.flowtype.line_ratio);

    if ($.trim(classes).length > 0) {
        classes = classes.split(',');
        $.each(classes, function(index, item) {
            element = '.' + $.trim(item);
            $(element).flowtype(options);
        });
    }

    if ($.trim(ids).length > 0) {
        ids = ids.split(',');
        $.each(ids, function(index, item) {
            element = '#' + $.trim(item);
            $(element).flowtype(options);
        });
    }

});