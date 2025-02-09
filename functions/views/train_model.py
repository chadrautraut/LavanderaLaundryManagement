import pandas as pd
from sklearn.model_selection import train_test_split
from sklearn.linear_model import LinearRegression
import joblib
import numpy as np

# Load your sales data from the database
# For this example, let's assume you have a CSV file with monthly sales data
# You can replace this with a database query to fetch the data
data = pd.read_csv('monthly_sales.csv')  # Replace with your actual data source

# Prepare the data
data['date'] = pd.to_datetime(data['date'])
data['month'] = data['date'].dt.month
data['year'] = data['date'].dt.year

# Group by year and month to get total sales
monthly_sales = data.groupby(['year', 'month'])['total_sales'].sum().reset_index()

# Create features and target variable
X = monthly_sales[['year', 'month']]
y = monthly_sales['total_sales']

# Split the data into training and testing sets
X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.2, random_state=42)

# Train the model
model = LinearRegression()
model.fit(X_train, y_train)

# Save the model
joblib.dump(model, 'sales_model.pkl')

print("Model trained and saved as sales_model.pkl")