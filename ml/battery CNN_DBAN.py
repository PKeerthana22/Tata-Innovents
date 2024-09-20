import tensorflow as tf
from tensorflow.keras import layers, models
import pandas as pd
import numpy as np
from sklearn.preprocessing import MinMaxScaler, Binarizer
from sklearn.model_selection import train_test_split
from sklearn.metrics import mean_squared_error, mean_absolute_error, accuracy_score, precision_score, recall_score, f1_score
import matplotlib.pyplot as plt
import seaborn as sns
from tkinter import Tk, Label, Button, Frame, filedialog
from tkintertable import TableCanvas, TableModel

# Load the dataset
df = pd.read_excel('dataset_tata_tiago_ev.xlsx')

# Data Visualization
plt.figure(figsize=(12, 6))
sns.histplot(df['Lifecycle Percentage'], kde=True, bins=30)
plt.title('Distribution of LifeCycle Percentage')
plt.xlabel('Lifecycle(%)')
plt.ylabel('Frequency')
plt.show()

# Correlation heatmap
plt.figure(figsize=(8, 6))
sns.heatmap(df.corr(), annot=True, cmap='coolwarm', fmt='.2f')
plt.title('Correlation Heatmap')
plt.show()


# Preprocess the dataset
X = df[['Voltage', 'Current', 'Temperature', 'Lifecycle Percentage', 'Discharge Rate', 'SOH']].values
y = df['Lifespan (months)'].values

# Split the data into training and testing sets
X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.2, random_state=42)
def create_cnn_dban_model(input_shape):
    inputs = layers.Input(shape=input_shape)

    # Reshape to (2, 3, 1) since 2 * 3 = 6 matches the input feature size
    x = layers.Reshape((2, 3, 1))(inputs)  
    x = layers.Conv2D(32, (3, 3), activation='relu', padding='same')(x)
    x = layers.Conv2D(64, (3, 3), activation='relu', padding='same')(x)
    x = layers.MaxPooling2D(pool_size=(2, 2))(x)
    x = layers.Flatten()(x)

    # Deep Bi-affine Network (DBAN)
    x1 = layers.Dense(64, activation='relu')(x)
    x2 = layers.Dense(64, activation='relu')(x)
    dban_output = layers.Dot(axes=1)([x1, x2])  # Bi-affine combination

    # Fully connected layers
    x = layers.Dense(128, activation='relu')(dban_output)
    x = layers.Dense(64, activation='relu')(x)
    output = layers.Dense(1)(x)  # Output layer

    model = models.Model(inputs, output)
    model.compile(optimizer='adam', loss='mean_squared_error', metrics=['mae'])

    return model


# Create and train the model
cnn_dban_model = create_cnn_dban_model((6,))
history = cnn_dban_model.fit(X_train, y_train, epochs=100, batch_size=32, validation_data=(X_test, y_test))
cnn_dban_model.save('trained_battery_power_model.h5')

# Evaluate the model
loss, mae = cnn_dban_model.evaluate(X_test, y_test)
print(f"Test Loss: {loss:.4f}, Test MAE: {mae:.4f}")

# Predict on test data
y_pred = cnn_dban_model.predict(X_test)

# Calculate and print regression metrics
mse = mean_squared_error(y_test, y_pred)
mae = mean_absolute_error(y_test, y_pred)
print(f"Mean Squared Error: {mse:.4f}")
print(f"Mean Absolute Error: {mae:.4f}")

# Convert predictions and true values to binary (threshold-based classification for evaluation purposes)
threshold = np.median(y_test)  # You can set this threshold based on your data distribution
binarizer = Binarizer(threshold=threshold)
y_test_binary = binarizer.transform(y_test.reshape(-1, 1))
y_pred_binary = binarizer.transform(y_pred)

# Plot training & validation loss and MAE
plt.figure(figsize=(12, 6))
plt.subplot(1, 2, 1)
plt.plot(history.history['loss'], label='Training Loss')
plt.plot(history.history['val_loss'], label='Validation Loss')
plt.xlabel('Epoch')
plt.ylabel('Loss')
plt.legend()
plt.title('Training and Validation Loss')

plt.subplot(1, 2, 2)
plt.plot(history.history['mae'], label='Training MAE')
plt.plot(history.history['val_mae'], label='Validation MAE')
plt.xlabel('Epoch')
plt.ylabel('Mean Absolute Error')
plt.legend()
plt.title('Training and Validation MAE')

plt.tight_layout()
plt.show()
