#!/usr/bin/env python3
"""
Simple Calculator App
Performs basic mathematical operations
"""

import math

class Calculator:
    def add(self, a, b):
        """Add two numbers"""
        return a + b
    
    def subtract(self, a, b):
        """Subtract b from a"""
        return a - b
    
    def multiply(self, a, b):
        """Multiply two numbers"""
        return a * b
    
    def divide(self, a, b):
        """Divide a by b"""
        if b == 0:
            raise ValueError("Cannot divide by zero")
        return a / b
    
    def power(self, a, b):
        """Calculate a to the power of b"""
        return a ** b
    
    def square_root(self, a):
        """Calculate square root"""
        if a < 0:
            raise ValueError("Cannot calculate square root of negative number")
        return math.sqrt(a)
    
    def percentage(self, a, b):
        """Calculate percentage: a% of b"""
        return (a / 100) * b

def main():
    calc = Calculator()
    
    print("=" * 50)
    print("      🧮 CALCULATOR APP")
    print("=" * 50)
    
    while True:
        print("\nOperations:")
        print("1. Add")
        print("2. Subtract")
        print("3. Multiply")
        print("4. Divide")
        print("5. Power")
        print("6. Square Root")
        print("7. Percentage")
        print("8. Exit")
        
        choice = input("\nEnter choice (1-8): ").strip()
        
        try:
            if choice == '8':
                print("Goodbye! 👋")
                break
            elif choice == '6':
                a = float(input("Enter number: "))
                result = calc.square_root(a)
                print(f"\n√{a} = {result}")
            elif choice == '7':
                a = float(input("Enter percentage: "))
                b = float(input("Enter number: "))
                result = calc.percentage(a, b)
                print(f"\n{a}% of {b} = {result}")
            elif choice in ['1', '2', '3', '4', '5']:
                a = float(input("Enter first number: "))
                b = float(input("Enter second number: "))
                
                if choice == '1':
                    result = calc.add(a, b)
                    print(f"\n{a} + {b} = {result}")
                elif choice == '2':
                    result = calc.subtract(a, b)
                    print(f"\n{a} - {b} = {result}")
                elif choice == '3':
                    result = calc.multiply(a, b)
                    print(f"\n{a} × {b} = {result}")
                elif choice == '4':
                    result = calc.divide(a, b)
                    print(f"\n{a} ÷ {b} = {result}")
                elif choice == '5':
                    result = calc.power(a, b)
                    print(f"\n{a} ^ {b} = {result}")
            else:
                print("Invalid choice")
        except ValueError as e:
            print(f"\n❌ Error: {e}")
        except Exception as e:
            print(f"\n❌ Error: {e}")

if __name__ == '__main__':
    main()
