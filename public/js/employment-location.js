var locationData = {
    "Philippines": {
        "01": {
            "region_name": "Region I",
            "province_list": {
                "Ilocos Norte": {
                    "municipality_list": {
                        "Laoag": {
                            "barangay_list": ["Barangay 1", "Barangay 2"]
                        },
                        "Batac": {
                            "barangay_list": ["Barangay 1", "Barangay 2"]
                        }
                    }
                },
                "Ilocos Sur": {
                    "municipality_list": {
                        "Vigan": {
                            "barangay_list": ["Barangay 1", "Barangay 2"]
                        }
                    }
                }
            }
        }
    }
};

$(document).ready(function() {
    $.each(locationData, function(country, regions) {
        $('#country').append(new Option(country, country));
    });

    $('#country').change(function() {
        const country = $(this).val();
        $('#region').empty().append(new Option("Select Region", "")).prop('disabled', false);
        $('#province, #city, #barangay').empty().prop('disabled', true).append(new Option("Select Province", ""));
        $('#location').val("");

        $.each(locationData[country], function(regionCode, regionData) {
            $('#region').append(new Option(regionData.region_name, regionCode));
        });
    });

    $('#region').change(function() {
        const country = $('#country').val();
        const regionCode = $(this).val();
        $('#province').empty().append(new Option("Select Province", "")).prop('disabled', false);
        $('#city, #barangay').empty().prop('disabled', true).append(new Option("Select City/Municipality", ""));
        $('#location').val("");

        const regionData = locationData[country][regionCode];
        $.each(regionData.province_list, function(province, data) {
            $('#province').append(new Option(province, province));
        });
    });

    $('#province').change(function() {
        const country = $('#country').val();
        const regionCode = $('#region').val();
        const province = $(this).val();
        $('#city').empty().append(new Option("Select City/Municipality", "")).prop('disabled', false);
        $('#barangay').empty().prop('disabled', true).append(new Option("Select Barangay", ""));
        $('#location').val("");

        const regionData = locationData[country][regionCode];
        const provinceData = regionData.province_list[province];
        $.each(provinceData.municipality_list, function(city, data) {
            $('#city').append(new Option(city, city));
        });
    });

    $('#city').change(function() {
        const country = $('#country').val();
        const regionCode = $('#region').val();
        const province = $('#province').val();
        const city = $(this).val();
        $('#barangay').empty().append(new Option("Select Barangay", "")).prop('disabled', false);
        $('#location').val("");

        const regionData = locationData[country][regionCode];
        const provinceData = regionData.province_list[province];
        const cityData = provinceData.municipality_list[city];
        $.each(cityData.barangay_list, function(index, barangay) {
            $('#barangay').append(new Option(barangay, barangay));
        });
    });

    $('#barangay').change(function() {
        const country = $('#country').val();
        const regionCode = $('#region').val();
        const regionName = $('#region option:selected').text();
        const province = $('#province').val();
        const city = $('#city').val();
        const barangay = $(this).val();
        const fullLocation = `${barangay}, ${city}, ${province}, ${regionName}, ${country}`;
        $('#location').val(fullLocation);
    });
});
