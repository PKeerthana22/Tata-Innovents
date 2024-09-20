import tensorflow as tf
from tensorflow.keras.models import load_model
from tkinter import Tk, Label, Button, Entry, Frame
import numpy as np
from sklearn.preprocessing import MinMaxScaler
import pandas as pd

# Load the trained ANN classification model
model = load_model('trained_ann_suggestion_model.h5')
print(model.summary())
# Load dataset for scaling
df = pd.read_excel('dataset_tata_tiago_ev.xlsx')
scaler = MinMaxScaler()
X = df[['Voltage', 'Current', 'Temperature', 'Lifecycle Percentage', 'Discharge Rate', 'SOH']].values
scaler.fit(X)

# Function to predict suggestion based on input values
def predict_suggestion():
    # Get inputs from the user
    voltage = float(voltage_entry.get())
    current = float(current_entry.get())
    temperature = float(temperature_entry.get())
    lifecycle1 = float(lifecycle_entry1.get())
    discharge_rate = float(discharge_entry.get())
    soh1 = float(SOH_entry1.get())

    # Prepare the input data and scale it
    input_data = np.array([[voltage, current, temperature, lifecycle1, discharge_rate, soh1]])
    input_data_scaled = scaler.transform(input_data)

    # Make prediction
    
    prediction = model.predict(input_data_scaled)
    predicted_class = np.argmax(prediction)  # Get the predicted class index

    # Mapping predicted class index to actual Suggestion (you should load the LabelEncoder here to get classes)
    suggestion_mapping = ['Consumed 25% lifecycle.', 'Consumed 50% lifecycle.', 'Overheating detected, Battery needs rest.', 'Voltage too low, check for potential damage.', 'Voltage/Current needs to be troubleshooted.']  # Modify based on your data
    predicted_suggestion = suggestion_mapping[predicted_class]

    # Display prediction
    prediction_label.config(text=f"Predicted Suggestion: {predicted_suggestion}")

# Function to create the UI
def create_ui():
    root = Tk()
    root.title("Battery Suggestion Prediction")

    # Create a frame for inputs
    frame = Frame(root)
    frame.pack(pady=20)

    # Input fields for Voltage, Current, Temperature, Discharge Rate
    Label(frame, text="Voltage:").grid(row=0, column=0, padx=10, pady=5)
    global voltage_entry
    voltage_entry = Entry(frame)
    voltage_entry.grid(row=0, column=1, padx=10, pady=5)

    Label(frame, text="Current:").grid(row=1, column=0, padx=10, pady=5)
    global current_entry
    current_entry = Entry(frame)
    current_entry.grid(row=1, column=1, padx=10, pady=5)

    Label(frame, text="Temperature:").grid(row=2, column=0, padx=10, pady=5)
    global temperature_entry
    temperature_entry = Entry(frame)
    temperature_entry.grid(row=2, column=1, padx=10, pady=5)

    Label(frame, text="Lifecycle Percentage:").grid(row=3, column=0, padx=10, pady=5)
    global lifecycle_entry1
    lifecycle_entry1 = Entry(frame)
    lifecycle_entry1.grid(row=3, column=1, padx=10, pady=5)
    

    Label(frame, text="Discharge Rate:").grid(row=4, column=0, padx=10, pady=5)
    global discharge_entry
    discharge_entry = Entry(frame)
    discharge_entry.grid(row=4, column=1, padx=10, pady=5)

    Label(frame, text="SOH:").grid(row=5, column=0, padx=10, pady=5)
    global SOH_entry1
    SOH_entry1 = Entry(frame)
    SOH_entry1.grid(row=5, column=1, padx=10, pady=5)
    
    # Predict button
    predict_button = Button(root, text="Predict", command=predict_suggestion)
    predict_button.pack(pady=20)

    # Prediction result label
    global prediction_label
    prediction_label = Label(root, text="Predicted Suggestion: ")
    prediction_label.pack(pady=5)
    
    root.mainloop()

# Run the UI
create_ui()
