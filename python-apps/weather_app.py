#!/usr/bin/env python3
"""
Simple Weather App
Simulates fetching and displaying weather information
"""

import random
from datetime import datetime

class WeatherApp:
    def __init__(self):
        self.weather_conditions = ['Sunny', 'Cloudy', 'Rainy', 'Partly Cloudy', 'Windy']
        self.cities_data = {
            'New York': {'lat': 40.7128, 'lon': -74.0060},
            'London': {'lat': 51.5074, 'lon': -0.1278},
            'Tokyo': {'lat': 35.6762, 'lon': 139.6503},
            'Paris': {'lat': 48.8566, 'lon': 2.3522},
            'Sydney': {'lat': -33.8688, 'lon': 151.2093}
        }
    
    def get_weather(self, city):
        """Simulate getting weather data for a city"""
        if city not in self.cities_data:
            return None
        
        # Simulate weather data
        temperature = random.randint(10, 30)
        condition = random.choice(self.weather_conditions)
        humidity = random.randint(30, 80)
        wind_speed = random.randint(5, 25)
        
        return {
            'city': city,
            'temperature': temperature,
            'condition': condition,
            'humidity': humidity,
            'wind_speed': wind_speed,
            'timestamp': datetime.now().strftime('%Y-%m-%d %H:%M:%S')
        }
    
    def display_weather(self, weather_data):
        """Display weather information"""
        if not weather_data:
            print("❌ City not found in database")
            return
        
        print("\n" + "=" * 50)
        print(f"      🌤️  Weather for {weather_data['city']}")
        print("=" * 50)
        print(f"Temperature: {weather_data['temperature']}°C")
        print(f"Condition:   {weather_data['condition']}")
        print(f"Humidity:    {weather_data['humidity']}%")
        print(f"Wind Speed:  {weather_data['wind_speed']} km/h")
        print(f"Updated:     {weather_data['timestamp']}")
        print("=" * 50)
    
    def list_cities(self):
        """List available cities"""
        print("\n📍 Available Cities:")
        for city in self.cities_data.keys():
            print(f"  • {city}")

def main():
    app = WeatherApp()
    
    print("=" * 50)
    print("      🌤️  WEATHER APP")
    print("=" * 50)
    
    while True:
        print("\nCommands:")
        print("1. Check weather")
        print("2. List cities")
        print("3. Exit")
        
        choice = input("\nEnter choice (1-3): ").strip()
        
        if choice == '1':
            city = input("Enter city name: ").strip()
            weather_data = app.get_weather(city)
            app.display_weather(weather_data)
        elif choice == '2':
            app.list_cities()
        elif choice == '3':
            print("Goodbye! 👋")
            break
        else:
            print("Invalid choice")

if __name__ == '__main__':
    main()
