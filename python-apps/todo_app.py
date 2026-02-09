#!/usr/bin/env python3
"""
Simple Todo List Application
A command-line task manager for tracking todos
"""

import json
import os
from datetime import datetime

class TodoApp:
    def __init__(self, filename='todos.json'):
        self.filename = filename
        self.todos = self.load_todos()
    
    def load_todos(self):
        """Load todos from JSON file"""
        if os.path.exists(self.filename):
            try:
                with open(self.filename, 'r') as f:
                    return json.load(f)
            except:
                return []
        return []
    
    def save_todos(self):
        """Save todos to JSON file"""
        with open(self.filename, 'w') as f:
            json.dump(self.todos, f, indent=2)
    
    def add_todo(self, task):
        """Add a new todo"""
        todo = {
            'id': len(self.todos) + 1,
            'task': task,
            'completed': False,
            'created': datetime.now().strftime('%Y-%m-%d %H:%M:%S')
        }
        self.todos.append(todo)
        self.save_todos()
        print(f"✓ Added: {task}")
    
    def list_todos(self):
        """List all todos"""
        if not self.todos:
            print("No todos yet!")
            return
        
        print("\n📝 Your Todos:")
        print("-" * 50)
        for todo in self.todos:
            status = "✓" if todo['completed'] else "○"
            print(f"{status} [{todo['id']}] {todo['task']}")
        print("-" * 50)
    
    def complete_todo(self, todo_id):
        """Mark a todo as completed"""
        for todo in self.todos:
            if todo['id'] == todo_id:
                todo['completed'] = True
                self.save_todos()
                print(f"✓ Completed: {todo['task']}")
                return
        print(f"Todo with ID {todo_id} not found")
    
    def delete_todo(self, todo_id):
        """Delete a todo"""
        for i, todo in enumerate(self.todos):
            if todo['id'] == todo_id:
                deleted = self.todos.pop(i)
                self.save_todos()
                print(f"✓ Deleted: {deleted['task']}")
                return
        print(f"Todo with ID {todo_id} not found")

def main():
    app = TodoApp()
    
    print("=" * 50)
    print("      📝 TODO LIST APP")
    print("=" * 50)
    
    while True:
        print("\nCommands:")
        print("1. Add todo")
        print("2. List todos")
        print("3. Complete todo")
        print("4. Delete todo")
        print("5. Exit")
        
        choice = input("\nEnter choice (1-5): ").strip()
        
        if choice == '1':
            task = input("Enter task: ").strip()
            if task:
                app.add_todo(task)
        elif choice == '2':
            app.list_todos()
        elif choice == '3':
            try:
                todo_id = int(input("Enter todo ID: "))
                app.complete_todo(todo_id)
            except ValueError:
                print("Invalid ID")
        elif choice == '4':
            try:
                todo_id = int(input("Enter todo ID: "))
                app.delete_todo(todo_id)
            except ValueError:
                print("Invalid ID")
        elif choice == '5':
            print("Goodbye! 👋")
            break
        else:
            print("Invalid choice")

if __name__ == '__main__':
    main()
