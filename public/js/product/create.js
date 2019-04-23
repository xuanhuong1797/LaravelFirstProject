$(function() {
    //Province
    var provinceSelected = $('#province_option')
        .children('option:selected')
        .val();
    var districtSelected = $('#district_option')
        .children('option:selected')
        .val();
    if (provinceSelected) {
        updateDistrictOption(provinceSelected);
    }
    if (districtSelected) {
        updateWardOption(districtSelected);
    }

    $('#province_option').change(function() {
        var selectedOption = $(this)
            .children('option:selected')
            .val();
        updateDistrictOption(selectedOption);
    });

    //District
    $('#district_option').change(function() {
        var selectedOption = $(this)
            .children('option:selected')
            .val();
        updateWardOption(selectedOption);
    });
});

function updateDistrictOption(selectedOption) {
    $('#district_option').html(
        $('<option>', {
            value: '',
            text: 'Please select your district',
            disabled: true,
            selected: true
        })
    );
    $.ajax({
        url: '/api/location/district',
        data: {
            province_id: selectedOption
        },
        success: function(result) {
            $.each(JSON.parse(result), function(i, item) {
                $('#district_option').append(
                    $('<option>', {
                        value: item.id,
                        text: item.name
                    })
                );
            });
        }
    });
}

function updateWardOption(selectedOption) {
    $('#ward_option').html(
        $('<option>', {
            value: '',
            text: 'Please select your ward',
            disabled: true,
            selected: true
        })
    );
    $.ajax({
        url: '/api/location/ward',
        data: {
            district_id: selectedOption
        },
        success: function(result) {
            $.each(JSON.parse(result), function(i, item) {
                $('#ward_option').append(
                    $('<option>', {
                        value: item.id,
                        text: item.name
                    })
                );
            });
        }
    });
}
