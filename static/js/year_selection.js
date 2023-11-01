jQuery(document).ready(function ($) {
    if ($("#graduate_year_selection")) {
        const thisYear = new Date().getFullYear();
        const lang = $("#graduate_year_selection").attr('lang');
        for (let i = 2012; i <= thisYear; i++) {
            if (lang === 'en') {
                $("#graduate_year_selection").prepend('<option value="' + i + '">Class of ' + i + '</option>');
            } else {
                $("#graduate_year_selection").prepend('<option value="' + i + '">' + i + ' 年畢業生</option>');
            }
        }
        $("#graduate_year_selection").val(data_vars.current_year);
        $("#graduate_year_selection").on('change', function () {
            $.ajax({
                url: data_vars.ajax_url, // WordPress AJAX handler
                dataType: 'json',
                type: 'post',
                data: {
                    action: 'filter_graduates_by_year',
                    year: $(this).val()
                },
                success: function (response) {
                    if (response.success) {
                        location.reload();
                    } else alert("error")
                }
            });
        });
    }
});




