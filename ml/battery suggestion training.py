import tensorflow as tf
from tensorflow.keras import layers, models
import pandas as pd
from sklearn.preprocessing import MinMaxScaler, LabelEncoder
from sklearn.model_selection import train_test_split
import matplotlib.pyplot as plt

# Load the dataset
df = pd.read_excel('dataset_tata_tiago_ev.xlsx')

# Encode the "Suggestion" column
label_encoder = LabelEncoder()
df['Suggestion_Encoded'] = label_encoder.fit_transform(df['Suggestion Condition'])
print(df['Suggestion_Encoded'])
df.to_excel('dataset_values.xlsx', index=False)
# Prepare input (Voltage, Current, Temperature, Discharge Rate) and output (Suggestion_Encoded)
X = df[['Voltage', 'Current', 'Temperature', 'Lifecycle Percentage', 'Discharge Rate', 'SOH']].values
y = df['Suggestion_Encoded'].values

# Normalize the input features
scaler = MinMaxScaler()
X_scaled = scaler.fit_transform(X)

# Split the dataset into training and testing sets
X_train, X_test, y_train, y_test = train_test_split(X_scaled, y, test_size=0.2, random_state=42)
print(X_test)
# Define the ANN model for classification
def create_ann_model(input_shape, num_classes):
    model = models.Sequential()
    model.add(layers.Dense(64, activation='relu', input_shape=(input_shape,)))
    model.add(layers.Dense(32, activation='relu'))
    model.add(layers.Dense(num_classes, activation='softmax'))  # Use softmax for multi-class classification
    model.compile(optimizer='adam', loss='sparse_categorical_crossentropy', metrics=['accuracy'])
    return model

# Get the number of unique classes (suggestions)
num_classes = len(label_encoder.classes_)

# Create and train the model
print(X_train.shape[1])
model = create_ann_model(X_train.shape[1], num_classes)
print(model.summary())
history = model.fit(X_train, y_train, epochs=10, batch_size=32, validation_data=(X_test, y_test))

# Save the trained model
model.save('trained_ann_suggestion_model.h5')

# Evaluate the model
loss, accuracy = model.evaluate(X_test, y_test)
print(f"Test Loss: {loss:.4f}, Test Accuracy: {accuracy:.4f}")

# Plot training & validation accuracy and loss
plt.figure(figsize=(12, 6))
plt.subplot(1, 2, 1)
plt.plot(history.history['loss'], label='Training Loss')
plt.plot(history.history['val_loss'], label='Validation Loss')
plt.xlabel('Epoch')
plt.ylabel('Loss')
plt.legend()
plt.title('Training and Validation Loss')

