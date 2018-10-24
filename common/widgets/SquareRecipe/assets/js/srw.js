$(document).ready(function () {

    $('.srw_dummy_div').click(function () {
        var id = ((this.id.split('_')).reverse())[0];
        $('#srw_annotation_'+id).toggleClass('srw_invisible');
        $('#srw_ing_div_'+id).toggleClass('srw_invisible');
        $('#srw_dummy_div_'+id).toggleClass('srw_dummy_div_full');
    });

    $('.srw_annotation').click(function () {
        var id = ((this.id.split('_')).reverse())[0];
        $('#srw_annotation_'+id).toggleClass('srw_annotation_full');
        $('#srw_dummy_div_'+id).toggleClass('srw_invisible');
        $('#srw_ing_div_'+id).toggleClass('srw_invisible');
    });

    $('.srw_ing_div').click(function () {
        var id = ((this.id.split('_')).reverse())[0];
        $('#srw_ing_div_'+id).toggleClass('srw_ing_div_full');
        $('#srw_dummy_div_'+id).toggleClass('srw_invisible');
        $('#srw_annotation_'+id).toggleClass('srw_invisible');
    });
});