# TrueUnion Mobile Platform Port Documentation

## Table of Contents
1. [Overview](#overview)
2. [Base URL & Environment](#base-url--environment)
3. [Authentication](#authentication)
4. [API Endpoints](#api-endpoints)
5. [Data Models](#data-models)
6. [Key Features](#key-features)
7. [Implementation Guidelines](#implementation-guidelines)
8. [Security Considerations](#security-considerations)
9. [Error Handling](#error-handling)
10. [Testing Guidelines](#testing-guidelines)

---

## Overview

This document provides comprehensive information for porting the TrueUnion web application to mobile platforms (iOS and Android). The document excludes all admin-related features and focuses solely on end-user functionality.

### Technology Stack
- **Backend**: Laravel (PHP 8.2+)
- **Authentication**: Session-based (web) / Token-based (recommended for mobile)
- **Database**: MySQL
- **File Storage**: Local storage (profile images)

### Mobile App Requirements
- User registration and authentication
- Profile management
- Match discovery and browsing
- Interest sending and management
- Real-time messaging
- Notifications
- Membership/subscription management
- User reporting

---

## Base URL & Environment

### Base URL
```
Production: https://yourdomain.com
Development: http://localhost:8000
```

### API Prefix
All API endpoints should be prefixed with `/api` for mobile applications. You may need to create an API route file (`routes/api.php`) and implement token-based authentication.

---

## Authentication

### Authentication Methods

#### 1. Email/Password Login
- **Endpoint**: `POST /login`
- **Request Body**:
```json
{
  "email": "user@example.com",
  "password": "password123"
}
```
- **Response** (Success):
```json
{
  "status": "success",
  "user": {
    "id": 1,
    "full_name": "John Doe",
    "email": "user@example.com",
    "profile_image": "profiles/profile_1_1234567890.jpeg",
    "role": "user"
  },
  "token": "api_token_here" // If implementing token auth
}
```

#### 2. Google OAuth
- **Endpoint**: `GET /auth/google`
- Redirects to Google OAuth flow
- **Callback**: `GET /auth/google/callback`
- Returns authenticated user data

#### 3. OTP-based Login (Mobile)
- **Send OTP**: `POST /otp/send`
  ```json
  {
    "mobile_number": "+919876543210"
  }
  ```
- **Verify OTP**: `POST /otp/verify`
  ```json
  {
    "mobile_number": "+919876543210",
    "otp": "123456"
  }
  ```

#### 4. Registration
- **Endpoint**: `POST /signup`
- **Request Body**:
```json
{
  "full_name": "John Doe",
  "email": "user@example.com",
  "password": "password123",
  "password_confirmation": "password123",
  "mobile_number": "+919876543210",
  "gender": "male",
  "dob": "1990-01-15",
  "country": "India",
  "state": "Maharashtra",
  "city": "Mumbai",
  "mother_tongue": "Hindi",
  "caste": "General"
}
```

#### 5. Logout
- **Endpoint**: `POST /logout`
- Requires authentication
- Clears session/token

### Session Management
- Web uses Laravel sessions (cookies)
- **For Mobile**: Implement token-based authentication (Laravel Sanctum or Passport recommended)
- Token should be sent in `Authorization: Bearer {token}` header

---

## API Endpoints

### Public Endpoints

#### Get Countries
- **Endpoint**: `POST /get-countries`
- **Response**:
```json
[
  {
    "id": 1,
    "name": "India",
    "status": 1
  }
]
```

#### Get States
- **Endpoint**: `POST /get-states`
- **Request Body**:
```json
{
  "country_id": 1
}
```

#### Get Cities
- **Endpoint**: `POST /get-cities`
- **Request Body**:
```json
{
  "state_id": 1
}
```

#### Get Education Details
- **Endpoint**: `GET /get-educations/{qualification_id}`
- **Response**:
```json
[
  {
    "id": 1,
    "name": "Bachelor of Engineering",
    "highest_qualification_id": 1,
    "status": 1
  }
]
```

### Authenticated User Endpoints

#### Dashboard
- **Endpoint**: `GET /dashboard`
- **Response**: User dashboard data including:
  - User profile summary
  - Recent matches
  - Pending requests count
  - Unread messages count
  - Unread notifications count

#### Profile Management

##### Get User Profile
- **Endpoint**: `GET /profile/{user_id}`
- **Response**:
```json
{
  "id": 1,
  "full_name": "John Doe",
  "email": "user@example.com",
  "profile_image": "profiles/profile_1_1234567890.jpeg",
  "gender": "male",
  "height": "5'10\"",
  "weight": "70 kg",
  "dob": "1990-01-15",
  "age": 34,
  "birth_time": "10:30 AM",
  "birth_place": "Mumbai",
  "raashi": "Aries",
  "caste": "General",
  "nakshtra": "Ashwini",
  "naadi": "Adi",
  "marital_status": "UnMarried",
  "mother_tongue": "Hindi",
  "physically_handicap": "no",
  "diet": "Vegetarian",
  "languages_known": "Hindi, English",
  "highest_education": "Bachelor's Degree",
  "education_details": "B.Tech Computer Science",
  "employed_in": "Private",
  "occupation": "Software Engineer",
  "annual_income": "500000-1000000",
  "country": "India",
  "state": "Maharashtra",
  "city": "Mumbai",
  "mobile_number": "+919876543210"
}
```

##### Edit Profile
- **Endpoint**: `GET /profile/edit`
- Returns form data with dropdown options

- **Update Profile**: `PATCH /profile`
- **Request Body**:
```json
{
  "full_name": "John Doe",
  "height": "5'10\"",
  "weight": "70 kg",
  "dob": "1990-01-15",
  "birth_time": "10:30 AM",
  "birth_place": "Mumbai",
  "raashi": "Aries",
  "caste": "General",
  "nakshtra": "Ashwini",
  "naadi": "Adi",
  "marital_status": "UnMarried",
  "mother_tongue": "Hindi",
  "physically_handicap": "no",
  "diet": "Vegetarian",
  "languages_known": "Hindi, English",
  "highest_education_id": 1,
  "education_id": 1,
  "education_details": "B.Tech Computer Science",
  "employed_in": "Private",
  "occupation_id": 1,
  "annual_income": "500000-1000000",
  "country_id": 1,
  "state_id": 1,
  "city_id": 1,
  "mobile_number": "+919876543210",
  "profile_image": "base64_encoded_image_or_file_upload"
}
```

#### Matches & Discovery

##### Get Matches
- **Endpoint**: `GET /matches`
- **Query Parameters**:
  - `page` (optional): Page number for pagination
  - `gender` (optional): Filter by gender
  - `age_min` (optional): Minimum age
  - `age_max` (optional): Maximum age
  - `city` (optional): Filter by city
  - `state` (optional): Filter by state
  - `country` (optional): Filter by country
- **Response**:
```json
{
  "matches": [
    {
      "id": 2,
      "full_name": "Jane Smith",
      "profile_image": "profiles/profile_2_1234567890.jpeg",
      "age": 28,
      "city": "Mumbai",
      "state": "Maharashtra",
      "occupation": "Doctor",
      "highest_education": "MBBS",
      "height": "5'6\"",
      "mother_tongue": "Hindi"
    }
  ],
  "current_page": 1,
  "total": 50,
  "per_page": 20
}
```

##### Search Users
- **Endpoint**: `GET /search`
- **Query Parameters**: Same as matches
- **Response**: Same format as matches

##### View User Profile
- **Endpoint**: `GET /profile/{user_id}`
- Returns full profile details (see Profile Management section)

#### Interests & Connections

##### Send Interest
- **Endpoint**: `POST /profile/{user_id}/send-interest`
- **Response**:
```json
{
  "status": "success",
  "message": "Interest sent successfully",
  "interest_id": 123
}
```

##### Accept Interest Request
- **Endpoint**: `POST /requests/{interest_id}/accept`
- **Response**:
```json
{
  "status": "success",
  "message": "Interest accepted",
  "connection_established": true
}
```

##### Decline Interest Request
- **Endpoint**: `POST /requests/{interest_id}/decline`
- **Response**:
```json
{
  "status": "success",
  "message": "Interest declined"
}
```

##### Get Pending Requests
- **Endpoint**: `GET /requests`
- **Response**:
```json
{
  "requests": [
    {
      "id": 123,
      "sender": {
        "id": 2,
        "full_name": "Jane Smith",
        "profile_image": "profiles/profile_2_1234567890.jpeg",
        "age": 28,
        "city": "Mumbai",
        "occupation": "Doctor"
      },
      "status": "pending",
      "created_at": "2025-01-15T10:30:00Z"
    }
  ]
}
```

##### Toggle Shortlist
- **Endpoint**: `POST /profile/{user_id}/toggle-shortlist`
- **Response**:
```json
{
  "status": "success",
  "is_shortlisted": true,
  "message": "Added to shortlist"
}
```

##### Get Shortlist
- **Endpoint**: `GET /shortlist`
- **Response**:
```json
{
  "shortlisted_users": [
    {
      "id": 2,
      "full_name": "Jane Smith",
      "profile_image": "profiles/profile_2_1234567890.jpeg",
      "age": 28,
      "city": "Mumbai",
      "occupation": "Doctor"
    }
  ]
}
```

#### Messaging

##### Get Messages List
- **Endpoint**: `GET /messages`
- **Response**:
```json
{
  "connections": [
    {
      "user": {
        "id": 2,
        "full_name": "Jane Smith",
        "profile_image": "profiles/profile_2_1234567890.jpeg"
      },
      "last_message": {
        "id": 456,
        "message": "Hello!",
        "sender_id": 1,
        "created_at": "2025-01-15T10:30:00Z",
        "is_read": true
      },
      "unread_count": 0
    }
  ]
}
```

##### Get Chat with User
- **Endpoint**: `GET /messages/chat/{user_id}`
- **Query Parameters**:
  - `last_message_id` (optional): ID of last loaded message for pagination
- **Response**:
```json
{
  "messages": [
    {
      "id": 456,
      "sender_id": 1,
      "receiver_id": 2,
      "message": "Hello!",
      "is_read": true,
      "created_at": "2025-01-15T10:30:00Z",
      "sender": {
        "id": 1,
        "full_name": "John Doe",
        "profile_image": "profiles/profile_1_1234567890.jpeg"
      }
    }
  ],
  "other_user": {
    "id": 2,
    "full_name": "Jane Smith",
    "profile_image": "profiles/profile_2_1234567890.jpeg",
    "age": 28,
    "occupation": "Doctor",
    "city": "Mumbai",
    "height": "5'6\"",
    "highest_education": "MBBS",
    "mother_tongue": "Hindi"
  }
}
```

##### Send Message
- **Endpoint**: `POST /messages/send/{user_id}`
- **Request Body**:
```json
{
  "message": "Hello! How are you?"
}
```
- **Response**:
```json
{
  "status": "success",
  "message": {
    "id": 457,
    "sender_id": 1,
    "receiver_id": 2,
    "message": "Hello! How are you?",
    "is_read": false,
    "created_at": "2025-01-15T10:35:00Z"
  }
}
```

##### Get New Messages
- **Endpoint**: `GET /messages/new/{user_id}`
- **Query Parameters**:
  - `last_message_id` (required): ID of last received message
- **Response**:
```json
{
  "newMessages": [
    {
      "id": 458,
      "sender_id": 2,
      "receiver_id": 1,
      "message": "I'm doing great!",
      "is_read": false,
      "created_at": "2025-01-15T10:36:00Z"
    }
  ]
}
```

#### Notifications

##### Get Notifications
- **Endpoint**: `GET /notifications`
- **Query Parameters**:
  - `filter` (optional): `all`, `matches`, `interests`, `messages`, `views`
  - `page` (optional): Page number
- **Response**:
```json
{
  "notifications": [
    {
      "id": 789,
      "type": "interest",
      "message": "Jane Smith sent you an interest",
      "icon": "heart",
      "icon_color": "red",
      "is_read": false,
      "created_at": "2025-01-15T10:30:00Z",
      "related_user": {
        "id": 2,
        "full_name": "Jane Smith",
        "profile_image": "profiles/profile_2_1234567890.jpeg"
      }
    }
  ],
  "unread_count": 5,
  "current_page": 1,
  "total": 20
}
```

##### Get Notifications (AJAX/Real-time)
- **Endpoint**: `GET /notifications/get`
- **Query Parameters**: Same as above
- **Response**: Same format as above

##### Mark Notification as Read
- **Endpoint**: `POST /notifications/{notification_id}/mark-read`
- **Response**:
```json
{
  "status": "success",
  "message": "Notification marked as read"
}
```

##### Mark All Notifications as Read
- **Endpoint**: `POST /notifications/mark-all-read`
- **Response**:
```json
{
  "status": "success",
  "message": "All notifications marked as read"
}
```

##### Get Unread Count
- **Endpoint**: `GET /notifications/unread-count`
- **Response**:
```json
{
  "unread_count": 5
}
```

#### Membership & Subscriptions

##### Get Membership Plans
- **Endpoint**: `GET /membership`
- **Response**:
```json
{
  "memberships": [
    {
      "id": 1,
      "name": "Free",
      "price": 0,
      "visits_allowed": 10,
      "features": "Basic features",
      "is_featured": false,
      "badge": null,
      "description": "Free plan with limited features",
      "is_active": true,
      "display_order": 0
    },
    {
      "id": 2,
      "name": "Premium",
      "price": 999,
      "visits_allowed": 100,
      "features": "Premium features",
      "is_featured": true,
      "badge": "MOST POPULAR",
      "description": "Premium plan with all features",
      "is_active": true,
      "display_order": 1
    }
  ]
}
```

##### Subscribe to Membership
- **Endpoint**: `POST /subscribe/{membership_id}`
- **Response**:
```json
{
  "status": "success",
  "message": "You have successfully subscribed to the Premium plan!",
  "membership": {
    "id": 2,
    "name": "Premium",
    "expires_at": "2025-02-15T10:30:00Z",
    "visits_used": 0,
    "visits_allowed": 100
  }
}
```

#### User Reporting

##### Report User
- **Endpoint**: `GET /report/{user_id}`
- Returns report form (for web) or report reasons (for mobile)

- **Submit Report**: `POST /report/{user_id}`
- **Request Body**:
```json
{
  "reason": "spam_scam",
  "details": "User is sending spam messages",
  "block_user": true
}
```
- **Response**:
```json
{
  "status": "success",
  "message": "Report submitted successfully"
}
```

**Report Reasons**:
- `spam_scam`
- `harassment`
- `inappropriate_photos`
- `underage`
- `other`

---

## Data Models

### User Model
```json
{
  "id": "integer",
  "google_id": "string|null",
  "full_name": "string",
  "gender": "string",
  "height": "string|null",
  "weight": "string|null",
  "dob": "date|null",
  "birth_time": "string|null",
  "birth_place": "string|null",
  "raashi": "string|null",
  "caste": "string|null",
  "nakshtra": "string|null",
  "naadi": "string|null",
  "marital_status": "string|null",
  "mother_tongue": "string|null",
  "physically_handicap": "string",
  "diet": "string|null",
  "languages_known": "text|null",
  "highest_education": "string|null",
  "education_details": "string|null",
  "employed_in": "string|null",
  "occupation": "string|null",
  "annual_income": "string|null",
  "country": "string",
  "state": "string",
  "city": "string",
  "mobile_number": "string|null",
  "email": "string",
  "email_verified_at": "datetime|null",
  "role": "enum:user,admin",
  "profile_image": "string|null",
  "created_at": "datetime",
  "updated_at": "datetime"
}
```

### Message Model
```json
{
  "id": "integer",
  "sender_id": "integer",
  "receiver_id": "integer",
  "message": "text",
  "is_read": "boolean",
  "created_at": "datetime",
  "updated_at": "datetime"
}
```

### Notification Model
```json
{
  "id": "integer",
  "user_id": "integer",
  "related_user_id": "integer|null",
  "type": "string",
  "message": "string",
  "icon": "string|null",
  "icon_color": "string|null",
  "is_read": "boolean",
  "metadata": "json|null",
  "created_at": "datetime",
  "updated_at": "datetime"
}
```

### Membership Model
```json
{
  "id": "integer",
  "name": "string",
  "price": "decimal",
  "visits_allowed": "integer",
  "features": "text|null",
  "is_featured": "boolean",
  "badge": "string|null",
  "description": "text|null",
  "is_active": "boolean",
  "display_order": "integer",
  "created_at": "datetime",
  "updated_at": "datetime"
}
```

### User Interest Model (user_interests table)
```json
{
  "id": "integer",
  "sender_id": "integer",
  "receiver_id": "integer",
  "status": "enum:pending,accepted,declined",
  "created_at": "datetime",
  "updated_at": "datetime"
}
```

### User Membership Model (user_memberships table)
```json
{
  "id": "integer",
  "user_id": "integer",
  "membership_id": "integer",
  "is_active": "boolean",
  "visits_used": "integer",
  "purchased_at": "datetime",
  "expires_at": "datetime|null",
  "created_at": "datetime",
  "updated_at": "datetime"
}
```

### Report Model
```json
{
  "id": "integer",
  "reporter_id": "integer",
  "reported_user_id": "integer",
  "reason": "string",
  "details": "text|null",
  "block_user": "boolean",
  "status": "enum:pending,reviewed,resolved,dismissed",
  "created_at": "datetime",
  "updated_at": "datetime"
}
```

---

## Key Features

### 1. User Registration & Authentication
- Email/password registration
- Google OAuth login
- OTP-based mobile login
- Session/token management

### 2. Profile Management
- Complete profile creation and editing
- Profile image upload
- Astrological details (raashi, nakshtra, naadi)
- Education and occupation details
- Location information

### 3. Match Discovery
- Browse potential matches
- Filter by age, location, education, etc.
- Search functionality
- View detailed profiles

### 4. Interest System
- Send interest to other users
- Accept/decline incoming interests
- View pending requests
- Shortlist favorite profiles
- Mutual interest required for messaging

### 5. Real-time Messaging
- Chat with mutually interested users
- Real-time message delivery
- Read receipts
- Message history
- Unread message indicators

### 6. Notifications
- Real-time notifications for:
  - New interests
  - Interest acceptances
  - New messages
  - Profile views
  - New matches
- Filter notifications by type
- Mark as read functionality
- Unread count badge

### 7. Membership Plans
- View available membership plans
- Subscribe to plans
- Track membership expiry
- Visit limits based on plan
- Free plan for all users

### 8. User Reporting
- Report users for inappropriate behavior
- Multiple report reasons
- Option to block user
- Report status tracking

---

## Implementation Guidelines

### 1. API Authentication
For mobile apps, implement token-based authentication:

```php
// Recommended: Use Laravel Sanctum
// Install: composer require laravel/sanctum
// Configure API routes in routes/api.php
```

**Token-based Auth Flow**:
1. User logs in via `/api/login`
2. Server returns API token
3. Mobile app stores token securely
4. Include token in all requests: `Authorization: Bearer {token}`
5. Token expires after set time or on logout

### 2. Image Upload
For profile images:
- Accept base64 encoded images or multipart/form-data
- Maximum file size: 5MB
- Supported formats: JPG, PNG, WebP
- Server will crop/resize images automatically
- Returns relative path: `profiles/profile_{user_id}_{timestamp}.{ext}`

### 3. Real-time Updates
For real-time features (messages, notifications):
- Implement polling mechanism (every 2-5 seconds)
- Use `last_message_id` or `last_notification_id` to fetch only new items
- Implement WebSocket connection if needed (Laravel Echo + Pusher/Socket.io)

### 4. Pagination
Most list endpoints support pagination:
- Use `page` query parameter
- Default: 20 items per page
- Response includes `current_page`, `total`, `per_page`, `last_page`

### 5. Error Handling
All endpoints return consistent error format:
```json
{
  "status": "error",
  "message": "Error description",
  "errors": {
    "field_name": ["Validation error message"]
  }
}
```

### 6. File Storage
- Profile images stored in `storage/app/public/profiles/`
- Access via: `{base_url}/storage/profiles/{filename}`
- Ensure `php artisan storage:link` is run on server

### 7. Localization
- Current languages: English (en), Hindi (hi), Gujarati (gu)
- Language switching: `GET /language/{locale}`
- Store user's language preference

---

## Security Considerations

### 1. Authentication
- Use HTTPS for all API calls
- Implement token expiration and refresh
- Store tokens securely (Keychain on iOS, Keystore on Android)
- Implement logout to invalidate tokens

### 2. Data Validation
- Validate all user inputs on mobile app
- Server-side validation is mandatory
- Sanitize user-generated content

### 3. Privacy
- Only show profiles to authenticated users
- Respect user privacy settings (if implemented)
- Don't expose sensitive data (email, phone) in public APIs

### 4. Rate Limiting
- Implement rate limiting on API endpoints
- Prevent abuse of messaging/interest features
- Limit profile views based on membership plan

### 5. Image Security
- Validate image file types and sizes
- Scan uploaded images for malicious content
- Implement image compression to reduce storage

---

## Error Handling

### HTTP Status Codes
- `200 OK`: Successful request
- `201 Created`: Resource created successfully
- `400 Bad Request`: Invalid request data
- `401 Unauthorized`: Authentication required
- `403 Forbidden`: Insufficient permissions
- `404 Not Found`: Resource not found
- `422 Unprocessable Entity`: Validation errors
- `500 Internal Server Error`: Server error

### Error Response Format
```json
{
  "status": "error",
  "message": "Error description",
  "errors": {
    "email": ["The email field is required."],
    "password": ["The password must be at least 8 characters."]
  }
}
```

### Common Error Scenarios
1. **Invalid Credentials**: `401` with message "Invalid email or password"
2. **Unauthorized Access**: `403` with message "You don't have permission"
3. **Resource Not Found**: `404` with message "User not found"
4. **Validation Errors**: `422` with field-specific errors
5. **Connection Required**: `403` with message "No connection found" (for messaging)

---

## Testing Guidelines

### 1. Unit Testing
- Test authentication flows
- Test data validation
- Test business logic

### 2. Integration Testing
- Test API endpoints
- Test database operations
- Test file uploads

### 3. Mobile App Testing
- Test on iOS and Android devices
- Test offline scenarios
- Test network error handling
- Test token expiration and refresh
- Test image upload/download
- Test real-time features (messaging, notifications)

### 4. Test Data
Use test users for development:
- Email: `alice@test.com` / Password: `password123`
- Email: `bob@test.com` / Password: `password123`

### 5. Performance Testing
- Test API response times
- Test image loading performance
- Test pagination with large datasets
- Test real-time polling efficiency

---

## Additional Notes

### 1. Membership Visits
- Each profile view counts as a visit
- Free plan: 10 visits
- Premium plans: Higher visit limits
- Visits reset on new membership purchase

### 2. Interest Status Flow
- `pending`: Interest sent, awaiting response
- `accepted`: Mutual interest established, can message
- `declined`: Interest rejected

### 3. Notification Types
- `interest`: New interest received
- `interest_accepted`: Interest accepted
- `message`: New message received
- `match`: New match found
- `profile_view`: Profile viewed

### 4. Profile Image Handling
- Images are automatically cropped/resized on upload
- Default image if none uploaded
- Update profile image via profile edit endpoint

### 5. Date Formats
- Use ISO 8601 format: `YYYY-MM-DDTHH:mm:ssZ`
- Example: `2025-01-15T10:30:00Z`

### 6. Language Support
- Default: English
- Supported: Hindi, Gujarati
- Language preference stored in session/cookie

---

## Support & Contact

For technical support or questions regarding the mobile port:
- Review Laravel documentation: https://laravel.com/docs
- Check API responses for error messages
- Test endpoints using Postman or similar tools
- Review server logs for debugging

---

**Document Version**: 1.0  
**Last Updated**: January 2025  
**Maintained By**: TrueUnion Development Team

