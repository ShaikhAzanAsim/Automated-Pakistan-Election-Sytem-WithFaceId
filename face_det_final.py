import cv2
import os
import numpy as np
from sklearn.preprocessing import LabelEncoder
from sklearn.neighbors import KNeighborsClassifier

# Function to extract labels from file names
def extract_label(file_name):
    return os.path.splitext(file_name)[0]

# Function to extract face embeddings using OpenCV
def extract_embeddings_with_opencv(face):
    # Load pre-trained face detection model
    face_cascade_path = 'haarcascade_frontalface_default.xml'
    face_cascade = cv2.CascadeClassifier(face_cascade_path)
    
    # Convert face image to grayscale
    gray = cv2.cvtColor(face, cv2.COLOR_BGR2GRAY)
    
    # Detect faces in the grayscale image
    faces = face_cascade.detectMultiScale(gray, scaleFactor=1.1, minNeighbors=5, minSize=(30, 30))
    
    # Check if any faces are detected
    if len(faces) == 0:
        print("Error: No faces detected.")
        return None
    
    # Assuming one face is detected, extract the first face
    (x, y, w, h) = faces[0]
    
    # Crop and resize the face region to a fixed size (e.g., 128x128)
    face_roi = gray[y:y+h, x:x+w]
    face_resized = cv2.resize(face_roi, (128, 128))
    
    # Normalize pixel values to [0, 1]
    face_normalized = face_resized / 255.0
    
    # Flatten the face embedding
    face_flattened = face_normalized.flatten()
    
    # Return the flattened face embedding
    return face_flattened

# Load dataset from folder
dataset_dir = 'dataset'

# Initialize lists to store flattened embeddings and corresponding labels
flattened_embeddings = []
labels = []

# Iterate through files in the dataset folder
for file_name in os.listdir(dataset_dir):
    if file_name.endswith('.jpg') or file_name.endswith('.png'):
        # Extract label from file name
        label = extract_label(file_name)
        
        # Load image
        image_path = os.path.join(dataset_dir, file_name)
        image = cv2.imread(image_path)
        
        # Extract face embeddings using OpenCV
        embedding = extract_embeddings_with_opencv(image)
        
        # Check if face embedding is extracted successfully
        if embedding is not None:
            # Append embedding and label to lists
            flattened_embeddings.append(embedding)
            labels.append(label)

# Convert labels (names) into numerical labels
label_encoder = LabelEncoder()
label_encoder.fit(labels)
numeric_labels = label_encoder.transform(labels)

# Convert flattened embeddings list to a two-dimensional array
flattened_embeddings_array = np.array(flattened_embeddings)

# Train a KNN classifier with the encoded labels
knn_classifier = KNeighborsClassifier(n_neighbors=1)
knn_classifier.fit(flattened_embeddings_array, numeric_labels)

# Initialize video capture from the laptop's camera
cap = cv2.VideoCapture(0)

# Initialize font for displaying text
font = cv2.FONT_HERSHEY_SIMPLEX

last_predicted_cnic = ""

while True:
    # Capture frame-by-frame
    ret, frame = cap.read()
    if not ret:
        print("Error: Failed to capture frame.")
        break
    
    # Extract embeddings (features) of the face using OpenCV
    face_embedding = extract_embeddings_with_opencv(frame)
    
    # Predict label for the face using the KNN classifier
    if face_embedding is not None:
        prediction = knn_classifier.predict([face_embedding])[0]
        
        # Convert numeric label back to the original name
        predicted_name = label_encoder.inverse_transform([prediction])[0]
        
        # Display name of the recognized person
        cv2.putText(frame, predicted_name, (50, 50), font, 1, (0, 255, 0), 2, cv2.LINE_AA)
        
        last_predicted_cnic = predicted_name

    # Display the frame
    cv2.imshow('Face Recognition', frame)
    
    # Break the loop if 'q' is pressed
    if cv2.waitKey(1) & 0xFF == ord('q'):
        break

# Release video capture and close windows
cap.release()
cv2.destroyAllWindows()

# Store only the first 15 characters of the last predicted name (CNIC)
cnic = last_predicted_cnic[:15]

# Write the CNIC to a text file
# Specify the full path for the output file
output_file_path = r'C:\xampp\htdocs\SE_PRO_V2\SE_PRO\last_predicted_cnic.txt'

# Write the CNIC to the text file
with open(output_file_path, 'w') as file:
    file.write(cnic)


# Output the last predicted name to the console
print("Last predicted cnic:", last_predicted_cnic)


