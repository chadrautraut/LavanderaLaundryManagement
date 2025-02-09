import joblib
import pandas as pd
from datetime import datetime, timedelta

# Load the trained model
model = joblib.load('sales_model.pkl')

# Get the current year and month
now = datetime.now()
current_year = now.year
current_month = now.month

# Prepare the data for the next 12 months
future_months = []
for i in range(1, 13):
    future_months.append([current_year, (current_month + i - 1) % 12 + 1])

# Convert to DataFrame
future_df = pd.DataFrame(future_months, columns=['year', 'month'])

# Make predictions
predictions = model.predict(future_df)

# Create a DataFrame for the predictions
predicted_sales = pd.DataFrame({
    'year': future_df['year'],
    'month': future_df['month'],
    'predicted_sales': predictions
})

# Save predictions to a CSV file
predicted_sales.to_csv('predicted_sales.csv', index=False)

print("Predictions saved to predicted_sales.csv")