jQuery( document ).ready( function($) {
    let conditionOne = $('body').find('.plugin-update-tr[data-slug="wpr-addons"]').length > 0;
    let conditionTwo = $('body').find('tr[data-slug="royal-elementor-addons-pro"]').length > 0 || $('body').find('tr[data-slug="wpr-addons-pro"]').length > 0 ||  $('body').find('tr[data-plugin="royal-elementor-addons-pro/wpr-addons-pro.php"]').length > 0 ||  $('body').find('tr[data-plugin="wpr-addons-pro/wpr-addons-pro.php"]').length > 0;
    
   if ( conditionOne && conditionTwo ) {
        let version = $('body').find('.plugin-update-tr[data-slug="wpr-addons"] .update-message').text();
        let matches = version.match(/\d+(\.\d+)+/);
        let updateVersion = matches ? matches[0] : '';

        
        let versionPro = $('body').find('tr[data-slug="royal-elementor-addons-pro"] .plugin-version-author-uri').text() || $('body').find('tr[data-slug="wpr-addons-pro"] .plugin-version-author-uri').text() || $('body').find('tr[data-plugin="royal-elementor-addons-pro/wpr-addons-pro.php"] .plugin-version-author-uri').text() || $('body').find('tr[data-plugin="wpr-addons-pro/wpr-addons-pro.php"] .plugin-version-author-uri').text();
        let matchesPro = versionPro.match(/\d+(\.\d+)+/);
        let proVersion = matchesPro ? matchesPro[0] : '';

        function wprCompareVersions(version1, version2) {
            // Extract the numeric parts of the versions
            let num1 = version1.match(/\d+(\.\d+)+/);
            let num2 = version2.match(/\d+(\.\d+)+/);
        
            if (num1 && num2) {
                // Convert the extracted numbers to floats for comparison
                let num1Float = parseFloat(num1[0]);
                let num2Float = parseFloat(num2[0]);
        
                // Compare the numbers
                if (num1Float >= num2Float) {
                    $('body').find('.plugin-update-tr[data-plugin="royal-elementor-addons/wpr-addons.php"]').remove();
                }
            }
        }
        
        wprCompareVersions(updateVersion, proVersion);  
    }

});