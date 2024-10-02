import pandas as pd

# Load the Excel files
all_transactions_path = 'C:/Users/HP/Documents/TAP/all_transactions.xlsx'  # Replace with actual path
all_settlements_path = 'C:/Users/HP/Documents/TAP/all_settlements.xlsx'    # Replace with actual path

# Load the data into DataFrames with the explicit use of the openpyxl engine
try:
    all_transactions_df = pd.read_excel(all_transactions_path, engine='openpyxl')
    all_settlements_df = pd.read_excel(all_settlements_path, engine='openpyxl')
except Exception as e:
    print(f"Error loading Excel files: {e}")
    exit()

# Ensure column names are correct and proceed with further logic
if 'charge_id' not in all_transactions_df.columns:
    print("Error: 'charge_id' column not found in all_transactions file.")
    exit()

if 'charge_id' not in all_settlements_df.columns:
    print("Error: 'charge_id' column not found in all_settlements file.")
    exit()

# Find records in all_transactions that do not exist in all_settlements based on charge_id
missing_charge_ids = all_transactions_df[~all_transactions_df['charge_id'].isin(all_settlements_df['charge_id'])]

# Output the result
if not missing_charge_ids.empty:
    print(f"Found {len(missing_charge_ids)} records missing from all_settlements.")
    # Save the missing records to a new Excel file
    missing_charge_ids.to_excel('C:/Users/HP/Documents/TAP/missing_charge_ids.xlsx', index=False)
    print("Missing records saved to missing_charge_ids.xlsx.")
else:
    print("No missing records found.")
