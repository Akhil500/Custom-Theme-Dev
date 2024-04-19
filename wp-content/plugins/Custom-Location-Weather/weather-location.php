<?php
/*
Plugin Name: Location Weather Report
Description: Provides advanced Weather locaton poadcast.
Version: 1.0
Author: Akhil HS
*/



// Function to fetch weather data from OpenWeatherMap API based on user search
function get_weather_data_by_location($location) {
    // Your OpenWeatherMap API key
    $api_key = '09de7696d9632d4da5474fe4ca21c397';

    // API URL
    $api_url = "http://api.openweathermap.org/data/2.5/weather?q={$location}&appid={$api_key}";

    // Fetch weather data
    $response = wp_remote_get($api_url);

    // Check if API request was successful
    if (!is_wp_error($response)) {
        // Parse JSON response
        $weather_data = json_decode($response['body'], true);

        // Return weather data
        return $weather_data;
    } else {
        // Return empty array if API request fails
        return array();
    }
}

// Function to display weather based on user search
function display_weather_by_location() {
    // Check if form is submitted
    if (isset($_POST['location'])) {
        // Get user input location
        $location = sanitize_text_field($_POST['location']);

        // Get weather data for the specified location
        $weather_data = get_weather_data_by_location($location);

        // Check if weather data is available
        if (!empty($weather_data)) {
            // Extract relevant weather information
            $temperature = round($weather_data['main']['temp'] - 273.15); // Convert temperature from Kelvin to Celsius
            $description = $weather_data['weather'][0]['description'];
            $name = $weather_data['name'];
            $icon = $weather_data['weather'][0]['icon'];

            // Display weather information
            echo "<div class='weather-widget'>";
            echo "<h2>Weather for {$location}</h2>";
            echo "<p>Temperature: {$temperature}°C</p>";
            echo "<p>Description: {$description}</p>";
            echo "<p>Place: {$name}</p>";
            echo "<img src='http://openweathermap.org/img/w/{$icon}.png' alt='Weather Icon'>";
            echo "</div>";
        } else {
            // Display error message if weather data is unavailable
            echo "<p>Weather data for {$location} unavailable</p>";
        }
    }

    // Display search form
    echo "<form method='post'>";
    echo "<input type='text' name='location' placeholder='Enter location'>";
    echo "<input type='submit' value='Get Weather'>";
    echo "</form>";
}

// Shortcode to display weather based on user search
function weather_by_location_shortcode() {
    ob_start();
    display_weather_by_location();
    return ob_get_clean();
}
add_shortcode('display_weather_by_location', 'weather_by_location_shortcode');

function enqueue_weather_styles() {
    wp_enqueue_style('weather-styles', plugins_url('style.css', __FILE__));
}
add_action('wp_enqueue_scripts', 'enqueue_weather_styles');
?>