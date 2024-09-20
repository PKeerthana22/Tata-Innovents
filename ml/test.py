import tensorflow as tf
from tensorflow.keras.models import load_model
from tkinter import Tk, Label, Button, Entry, Frame
import matplotlib.pyplot as plt

# Load the trained model
model = load_model('trained_battery_rul_model.h5')

# Function to predict power for 3 stations and plot the comparison graph
def predict_three_stations():
    # Station 1 inputs
    temp1 = float(voltage_entry1.get())
    humidity1 = float(current_entry1.get())
    irradiance1 = float(temperature_entry1.get())
    
    lifecycle1 = float(lifecycle_entry1.get())
    wind_speed1 = float(discharge_entry1.get())
    soh1 = float(SOH_entry1.get())
    time1 = float(time_entry1.get())
    ctime1 = float(ctime_entry1.get())
    # Prepare the input data for prediction
    input_data1 = [[temp1, humidity1, irradiance1, lifecycle1, wind_speed1, soh1, time1, ctime1]]
    
    # Make predictions
    prediction1 = model.predict(input_data1)[0][0]

    # Display predictions and best station recommendation
    prediction_label1.config(text=f"Predicted RUL: {prediction1:.2f} ")

# Function to create the UI
def create_ui():
    root = Tk()
    root.title("Battery RUL Prediction")

    # Create a frame for inputs
    frame = Frame(root)
    frame.pack(pady=20)

    # Station 1 inputs
    Label(frame, text="Cycle_Index:").grid(row=0, column=0, padx=10, pady=5)
    global voltage_entry1
    voltage_entry1 = Entry(frame)
    voltage_entry1.grid(row=0, column=1, padx=10, pady=5)

    Label(frame, text="Discharge Time (s): ").grid(row=1, column=0, padx=10, pady=5)
    global current_entry1
    current_entry1 = Entry(frame)
    current_entry1.grid(row=1, column=1, padx=10, pady=5)

    Label(frame, text="Decrement 340-320V (s): ").grid(row=2, column=0, padx=10, pady=5)
    global temperature_entry1
    temperature_entry1 = Entry(frame)
    temperature_entry1.grid(row=2, column=1, padx=10, pady=5)

    Label(frame, text="Max. Voltage Dischar. (V):").grid(row=3, column=0, padx=10, pady=5)
    global lifecycle_entry1
    lifecycle_entry1 = Entry(frame)
    lifecycle_entry1.grid(row=3, column=1, padx=10, pady=5)
    
    Label(frame, text="Min. Voltage Charg. (V):").grid(row=4, column=0, padx=10, pady=5)
    global discharge_entry1
    discharge_entry1 = Entry(frame)
    discharge_entry1.grid(row=4, column=1, padx=10, pady=5)

    Label(frame, text="Time at 340V (s):").grid(row=5, column=0, padx=10, pady=5)
    global SOH_entry1
    SOH_entry1 = Entry(frame)
    SOH_entry1.grid(row=5, column=1, padx=10, pady=5)
    
    Label(frame, text="Time constant current (s):").grid(row=6, column=0, padx=10, pady=5)
    global time_entry1
    time_entry1 = Entry(frame)
    time_entry1.grid(row=6, column=1, padx=10, pady=5)

    Label(frame, text="Charging time (s):").grid(row=7, column=0, padx=10, pady=5)
    global ctime_entry1
    ctime_entry1 = Entry(frame)
    ctime_entry1.grid(row=7, column=1, padx=10, pady=5)
    
    # Predict button
    predict_button = Button(root, text="Predict", command=predict_three_stations)
    predict_button.pack(pady=20)

    # Prediction result labels
    global prediction_label1, prediction_label2, prediction_label3, best_station_label
    prediction_label1 = Label(root, text="Predicted RUL: ")
    prediction_label1.pack(pady=5)
    
    root.mainloop()

create_ui()
