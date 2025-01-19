# Video API Documentation

Postman collection JSON is located at:

```
./postman-collection.json
```

## Overview

This API allows you to manage videos, including listing, streaming, uploading, retrieving details, and deleting videos.

### Base URL

```
{{server-api-url}}
```

### Authentication

All requests require Bearer Token authentication:

```json
{
    "Authorization": "Bearer {{api-token}}"
}
```

---

## Endpoints

### 1. Video List

**GET** `/video`

#### Headers:

-   `Accept: application/json`

#### Response:

Returns a list of videos.

---

### 2. Video Stream

**GET** `/video/{id}/stream`

#### Description:

Streams a video by its ID.

---

### 3. Video Thumbnail

**GET** `/video/{id}/thumbnail`

#### Description:

Retrieves the thumbnail for a video by its ID.

---

### 4. Video Details

**GET** `/video/{id}`

#### Description:

Fetches details for a specific video by its ID.

---

### 5. Video Upload

**POST** `/video`

#### Description:

Uploads a new video.

#### Body (FormData):

-   `title` (string): Title of the video.
-   `description` (string): Description of the video.
-   `video` (file): The video file to upload.
-   `thumbnail` (file): The thumbnail image for the video.

---

### 6. Video Delete

**DELETE** `/video/{id}`

#### Description:

Deletes a video by its ID.

#### Body (FormData):

-   `title` (string): Title of the video.
-   `description` (string): Description of the video.
