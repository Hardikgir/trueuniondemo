# TrueUnion User-Side UI/UX Plan

## Table of Contents
1. [Design System](#design-system)
2. [Navigation Structure](#navigation-structure)
3. [Screen Specifications](#screen-specifications)
4. [Component Library](#component-library)
5. [User Flows](#user-flows)
6. [Responsive Design](#responsive-design)
7. [Accessibility Guidelines](#accessibility-guidelines)
8. [Animation & Transitions](#animation--transitions)
9. [Loading States](#loading-states)
10. [Error States](#error-states)

---

## Design System

### Color Palette

#### Primary Colors
- **Primary Red**: `#ec3713` (RGB: 236, 55, 19)
  - Used for: CTAs, active states, highlights, hover effects
  - Hover: `#c52b0d` (RGB: 197, 43, 13)
  - Light variant: `rgba(236, 55, 19, 0.1)` for backgrounds
  - Shadow: `rgba(236, 55, 19, 0.5)` for glow effects

#### Background Colors
- **Light Background**: `#f8f6f6` (RGB: 248, 246, 246)
- **Dark Background**: `#181211` (RGB: 24, 18, 17)
  - Main background for dark mode
- **Surface Dark**: `#271d1c` (RGB: 39, 29, 28)
  - Cards, containers, elevated surfaces
- **Surface Border**: `#392b28` (RGB: 57, 43, 40)
  - Borders, dividers, hover states

#### Text Colors
- **Primary Text**: `#ffffff` (White)
  - Main content, headings
- **Secondary Text**: `#b9a19d` (RGB: 185, 161, 157)
  - Muted text, placeholders, inactive states
- **Text Muted**: `#b9a19d` (Same as secondary)

#### Status Colors
- **Success**: `#10b981` (Green) with `rgba(16, 185, 129, 0.2)` background
- **Error**: `#ef4444` (Red) with `rgba(239, 68, 68, 0.2)` background
- **Warning**: `#f59e0b` (Amber) with `rgba(245, 158, 11, 0.2)` background
- **Info**: `#3b82f6` (Blue) with `rgba(59, 130, 246, 0.2)` background

#### Neutral Colors
- **Gray Scale**:
  - `#ffffff` - Pure white
  - `#f8f6f6` - Light gray background
  - `#b9a19d` - Medium gray (muted text)
  - `#392b28` - Dark gray (borders)
  - `#271d1c` - Darker gray (surfaces)
  - `#181211` - Darkest gray (background)

### Typography

#### Font Family
- **Primary Font**: Newsreader (Serif)
  - Google Fonts: `https://fonts.googleapis.com/css2?family=Newsreader`
  - Weights: 200-800 (variable)
  - Styles: Regular, Italic
- **Fallback**: System serif fonts

#### Font Sizes
- **Display Large**: `5xl` (3rem / 48px) - Hero headings
- **Display Medium**: `4xl` (2.25rem / 36px) - Section headings
- **Display Small**: `3xl` (1.875rem / 30px) - Page titles
- **Heading 1**: `2xl` (1.5rem / 24px) - Main headings
- **Heading 2**: `xl` (1.25rem / 20px) - Subheadings
- **Heading 3**: `lg` (1.125rem / 18px) - Card titles
- **Body Large**: `base` (1rem / 16px) - Body text
- **Body Medium**: `sm` (0.875rem / 14px) - Secondary text
- **Body Small**: `xs` (0.75rem / 12px) - Captions, labels

#### Font Weights
- **Black**: 800 - Hero text, emphasis
- **Bold**: 700 - Headings, important text
- **Semibold**: 600 - Subheadings
- **Medium**: 500 - Navigation, buttons
- **Regular**: 400 - Body text

#### Line Heights
- **Tight**: `leading-tight` (1.25) - Headings
- **Normal**: `leading-normal` (1.5) - Body text
- **Relaxed**: `leading-relaxed` (1.75) - Long paragraphs

#### Letter Spacing
- **Tight**: `tracking-tight` (-0.025em) - Headings
- **Normal**: Default - Body text

### Spacing System

Based on Tailwind's spacing scale (4px base unit):
- **xs**: 0.25rem (4px)
- **sm**: 0.5rem (8px)
- **md**: 1rem (16px)
- **lg**: 1.5rem (24px)
- **xl**: 2rem (32px)
- **2xl**: 2.5rem (40px)
- **3xl**: 3rem (48px)
- **4xl**: 4rem (64px)

### Border Radius
- **None**: 0
- **Small**: `rounded` (0.375rem / 6px) - Buttons, inputs
- **Medium**: `rounded-lg` (0.5rem / 8px) - Cards
- **Large**: `rounded-xl` (0.75rem / 12px) - Large cards
- **Extra Large**: `rounded-2xl` (1rem / 16px) - Modals
- **Full**: `rounded-full` (9999px) - Pills, avatars

### Shadows
- **Small**: `shadow-sm` - Subtle elevation
- **Medium**: `shadow-md` - Cards
- **Large**: `shadow-lg` - Modals
- **Glow (Primary)**: `shadow-[0_0_40px_-10px_rgba(236,55,19,0.5)]` - CTA buttons

### Icons
- **Icon Library**: Material Symbols Outlined
- **CDN**: Google Fonts Material Symbols
- **Size Variants**: 
  - Small: `text-lg` (18px)
  - Medium: `text-xl` (20px)
  - Large: `text-2xl` (24px)
  - Extra Large: `text-3xl` (30px)
- **Fill Variant**: Use `fill` class for filled icons

### Scrollbars
- **Width**: 8px
- **Track Color**: `#221310` (dark)
- **Thumb Color**: `#392b28` (medium)
- **Thumb Hover**: `#ec3713` (primary)
- **Border Radius**: 4px

---

## Navigation Structure

### Main Navigation (Desktop Sidebar)

#### Sidebar Specifications
- **Width**: 320px (20rem / `w-80`)
- **Position**: Fixed left
- **Background**: `bg-surface-dark` (#271d1c)
- **Height**: 100vh
- **Z-index**: 50
- **Padding**: `px-4 py-6`

#### Sidebar Components

##### 1. User Profile Section (Top)
- **Height**: Auto
- **Padding**: `pb-4 mb-4 border-b border-surface-border`
- **Content**:
  - Profile Image: 64x64px, rounded-full
  - User Name: Bold, white text
  - User Email: Small, muted text
  - Edit Profile Link: Small, primary color

##### 2. Navigation Links
- **Spacing**: `gap-2` (8px between items)
- **Link Style**:
  - Padding: `px-4 py-3`
  - Border Radius: `rounded-xl`
  - Active State: `bg-[#392b28] text-white`
  - Hover State: `hover:bg-[#392b28] text-text-secondary hover:text-white`
  - Icon Size: `text-xl`
  - Icon Color: Primary on active/hover

##### 3. Navigation Items
1. **Dashboard**
   - Icon: `home`
   - Route: `/dashboard`
   - Badge: None

2. **Matches**
   - Icon: `favorite`
   - Route: `/matches`
   - Badge: None

3. **Shortlist**
   - Icon: `bookmark`
   - Route: `/shortlist`
   - Badge: Count (if items exist)

4. **Messages**
   - Icon: `chat_bubble`
   - Route: `/messages`
   - Badge: Unread message count (red, rounded-full)

5. **Requests**
   - Icon: `mail`
   - Route: `/requests`
   - Badge: Pending requests count

6. **Notifications**
   - Icon: `notifications`
   - Route: `/notifications`
   - Badge: Unread notification count (red, rounded-full)

7. **Profile**
   - Icon: `person`
   - Route: `/profile/edit`
   - Badge: None

8. **Membership**
   - Icon: `workspace_premium`
   - Route: `/membership`
   - Badge: "Premium" if premium user

9. **Logout**
   - Icon: `logout`
   - Route: `/logout` (POST)
   - Badge: None
   - Color: Red/warning on hover

### Top Navigation Bar (Public Pages)

#### Specifications
- **Height**: Auto (sticky)
- **Background**: `bg-background-dark/95 backdrop-blur-md`
- **Border**: `border-b border-surface-border`
- **Padding**: `px-4 lg:px-10 py-3`
- **Z-index**: 50
- **Position**: Sticky top

#### Components
1. **Logo Section**
   - Icon: `diversity_1` (Material Symbol)
   - Text: "TrueUnion" or "Matrimony"
   - Size: `text-xl font-bold`
   - Color: White

2. **Navigation Links** (Desktop only)
   - Home
   - About Us
   - Success Stories
   - Membership
   - Spacing: `gap-9`
   - Active: Bold, white
   - Inactive: Muted, hover to white

3. **Auth Buttons**
   - **Not Logged In**: "Login" button (primary)
   - **Logged In**: Profile icon dropdown
     - Profile link
     - Logout option

### Mobile Navigation

#### Bottom Navigation Bar (Mobile)
- **Height**: 64px
- **Background**: `bg-surface-dark`
- **Border**: `border-t border-surface-border`
- **Position**: Fixed bottom
- **Z-index**: 50
- **Items**: 5 main items (Dashboard, Matches, Messages, Notifications, Profile)
- **Icons**: Material Symbols, 24px
- **Active Indicator**: Primary color underline

#### Hamburger Menu (Mobile)
- **Position**: Top left
- **Icon**: `menu` (Material Symbol)
- **Size**: 24px
- **Color**: White
- **Action**: Opens sidebar drawer

---

## Screen Specifications

### 1. Home Page (Landing Page)

#### Layout Structure
- **Full Width**: 100vw
- **Background**: Dark gradient
- **Sections**: Multiple full-width sections

#### Section 1: Hero Section
- **Height**: 100vh (minimum)
- **Background**: Dark with gradient overlay
- **Content**:
  - Main Heading: "Find Your Perfect Match"
    - Size: `text-5xl md:text-7xl`
    - Weight: Black (800)
    - Color: White with primary accent
  - Subheading: Descriptive text
    - Size: `text-xl`
    - Color: Gray-400
  - CTA Buttons:
    - Primary: "Begin Your Journey" (primary color)
    - Secondary: "View Success Stories" (outlined)
    - Size: `text-lg px-8 py-4`
    - Border Radius: `rounded-full`
    - Hover: Glow effect on primary

#### Section 2: Features Section
- **Layout**: 3-column grid (desktop), 1-column (mobile)
- **Cards**:
  - Background: `bg-surface-dark`
  - Border: `border border-surface-border`
  - Padding: `p-6`
  - Border Radius: `rounded-xl`
  - Icon: Material Symbol, 48px, primary color
  - Title: `text-xl font-bold`
  - Description: `text-text-secondary`

#### Section 3: How It Works
- **Layout**: Horizontal timeline or vertical steps
- **Step Cards**:
  - Number badge (primary color, circular)
  - Title
  - Description
  - Icon

#### Section 4: Success Stories Preview
- **Layout**: Grid of 3-4 story cards
- **Card**:
  - Image: Profile photo or couple photo
  - Names
  - Short quote
  - "Read More" link

#### Section 5: CTA Section
- **Background**: Gradient with primary color
- **Content**: Final call-to-action
- **Buttons**: Same as hero section

#### Footer
- **Background**: `bg-surface-dark`
- **Border**: `border-t border-border-dark`
- **Content**:
  - Logo
  - Links (About, Success Stories, Terms, Contact)
  - Social Media Icons
  - Copyright

### 2. Login Page

#### Layout
- **Container**: Centered, max-width 448px
- **Background**: Dark
- **Padding**: `px-6 py-8`

#### Components

##### Header
- Logo (top center)
- Title: "Welcome Back"
- Subtitle: "Sign in to continue"

##### Form
- **Email Input**:
  - Label: "Email Address"
  - Type: email
  - Placeholder: "Enter your email"
  - Style: `bg-surface-dark border border-surface-border rounded-lg px-4 py-3`
  - Focus: Primary border color

- **Password Input**:
  - Label: "Password"
  - Type: password
  - Placeholder: "Enter your password"
  - Show/Hide toggle icon
  - Same styling as email

- **Remember Me**:
  - Checkbox
  - Label: "Remember me"

- **Forgot Password Link**:
  - Right-aligned
  - Primary color
  - Small text

- **Submit Button**:
  - Full width
  - Primary background
  - White text
  - Padding: `py-3`
  - Border Radius: `rounded-lg`
  - Hover: Darker primary

##### Social Login
- **Divider**: "Or continue with"
- **Google Button**:
  - Outlined style
  - Google icon
  - Full width

##### Footer Links
- "Don't have an account? Sign up"
- Link to signup page

### 3. Signup/Registration Page

#### Layout
- **Container**: Centered, max-width 768px
- **Multi-step Form**: Tabbed or wizard style

#### Steps

##### Step 1: Basic Information
- Full Name
- Email
- Password
- Confirm Password
- Mobile Number
- Gender (Radio buttons or dropdown)

##### Step 2: Personal Details
- Date of Birth
- Birth Time
- Birth Place
- Height
- Weight
- Marital Status

##### Step 3: Astrological Details
- Raashi (Dropdown)
- Nakshtra (Dropdown)
- Naadi (Dropdown)

##### Step 4: Location
- Country (Dropdown)
- State (Dropdown, depends on country)
- City (Dropdown, depends on state)

##### Step 5: Education & Career
- Highest Education (Dropdown)
- Education Details (Dropdown, depends on highest education)
- Occupation (Dropdown)
- Annual Income
- Employed In

##### Step 6: Additional Details
- Mother Tongue (Dropdown)
- Caste (Dropdown)
- Diet
- Languages Known (Multi-select)
- Physically Handicap (Yes/No)

##### Step 7: Profile Photo
- Image Upload
- Crop functionality
- Preview

#### Form Elements
- **Inputs**: Same styling as login
- **Dropdowns**: Custom styled select
- **Radio Buttons**: Custom styled
- **Checkboxes**: Custom styled
- **Progress Indicator**: Shows current step
- **Navigation**: Previous/Next buttons
- **Submit**: Final step only

### 4. Dashboard

#### Layout
- **Sidebar**: Fixed left (320px)
- **Main Content**: `ml-80` (margin-left for sidebar)
- **Max Width**: 1280px centered
- **Padding**: `px-4 sm:px-6 lg:px-10 py-8`

#### Header Section
- **Title**: "Dashboard"
  - Size: `text-3xl font-bold`
- **Subtitle**: Welcome message with user name

#### Stats Cards (Grid)
- **Layout**: 4-column grid (desktop), 2-column (tablet), 1-column (mobile)
- **Card Style**:
  - Background: `bg-surface-dark`
  - Border: `border border-surface-border`
  - Padding: `p-6`
  - Border Radius: `rounded-xl`
- **Content**:
  - Icon (Material Symbol, 32px, primary color)
  - Number (Large, bold, white)
  - Label (Small, muted)
  - Trend indicator (optional)

#### Quick Actions
- **Layout**: Horizontal scroll or grid
- **Buttons**:
  - "View Matches"
  - "Check Requests"
  - "View Messages"
  - "Edit Profile"
  - Style: Outlined, primary border

#### Recent Activity
- **Section Title**: "Recent Activity"
- **List Items**:
  - Icon
  - Description
  - Timestamp (relative)
  - Link to detail

#### Recommended Matches Preview
- **Section Title**: "Recommended for You"
- **Layout**: Horizontal scroll cards
- **Card**:
  - Profile Image (circular, 120px)
  - Name
  - Age, Location
  - "View Profile" button
  - "Send Interest" button

### 5. Matches Page

#### Layout
- **Sidebar**: Fixed left
- **Main Content**: Grid layout

#### Filters Section
- **Position**: Top of page
- **Layout**: Horizontal scroll or collapsible
- **Filters**:
  - Age Range (Slider)
  - Location (Dropdowns: Country, State, City)
  - Education (Dropdown)
  - Occupation (Dropdown)
  - Height (Range)
  - Marital Status (Checkboxes)
  - Apply/Reset buttons

#### Results Section

##### Grid View (Default)
- **Layout**: 3-column grid (desktop), 2-column (tablet), 1-column (mobile)
- **Card Specifications**:
  - **Width**: Auto (responsive)
  - **Height**: Auto
  - **Background**: `bg-surface-dark`
  - **Border**: `border border-surface-border`
  - **Border Radius**: `rounded-xl`
  - **Padding**: `p-4`
  - **Hover**: Scale up slightly, shadow

- **Card Content**:
  - **Image Section**:
    - Profile photo (aspect ratio 4:5)
    - Overlay: Name, age (bottom left)
    - Badge: "New" or "Premium" (top right, if applicable)
    - Favorite icon (top right, toggle)
  
  - **Info Section**:
    - Name (Bold, large)
    - Age, Location (Muted text)
    - Education, Occupation (Small text)
    - Height, Mother Tongue (Small text)
  
  - **Action Buttons**:
    - "View Profile" (Outlined, full width)
    - "Send Interest" (Primary, full width)
    - Spacing: `gap-2`

##### List View (Alternative)
- **Layout**: Vertical list
- **Card**: Horizontal layout
  - Image: 120x120px (left)
  - Info: Right side
  - Actions: Right side

#### Pagination
- **Style**: Numbered pages or "Load More"
- **Position**: Bottom of results
- **Active**: Primary color
- **Inactive**: Muted

### 6. Profile View Page

#### Layout
- **Sidebar**: Fixed left
- **Main Content**: Single column, max-width 800px

#### Header Section
- **Background**: Gradient or image
- **Content**:
  - Profile Image (Large, 200x200px, circular)
  - Name (Large, bold)
  - Age, Location
  - Online status indicator (if applicable)

#### Action Buttons
- **Layout**: Horizontal, top right
- **Buttons**:
  - "Send Interest" (Primary)
  - "Add to Shortlist" (Outlined)
  - "Report User" (Text, red on hover)
  - "View Full Profile" (Secondary)

#### Content Sections

##### Basic Information
- **Card**: `bg-surface-dark`, `rounded-xl`, `p-6`
- **Fields**:
  - Gender
  - Date of Birth
  - Height
  - Weight
  - Marital Status
  - Mother Tongue

##### Astrological Details
- **Card**: Same styling
- **Fields**:
  - Raashi
  - Nakshtra
  - Naadi
  - Birth Time
  - Birth Place

##### Education & Career
- **Card**: Same styling
- **Fields**:
  - Highest Education
  - Education Details
  - Occupation
  - Annual Income
  - Employed In

##### Location
- **Card**: Same styling
- **Fields**:
  - Country
  - State
  - City

##### Additional Information
- **Card**: Same styling
- **Fields**:
  - Diet
  - Languages Known
  - Physically Handicap

##### Photos Section
- **Layout**: Grid of images
- **Image Size**: 150x150px
- **Border Radius**: `rounded-lg`
- **Click**: Opens lightbox/modal

#### Right Sidebar (Desktop)
- **Position**: Fixed right or sticky
- **Width**: 320px
- **Content**:
  - Quick Stats
  - Mutual Interests
  - Similar Profiles
  - Contact Information (if premium)

### 7. Edit Profile Page

#### Layout
- **Sidebar**: Fixed left
- **Main Content**: Form layout, max-width 900px

#### Form Structure
- **Tabs or Sections**:
  1. Basic Information
  2. Personal Details
  3. Astrological Details
  4. Location
  5. Education & Career
  6. Additional Information
  7. Photos

#### Form Elements

##### Input Fields
- **Label**: Above input, small, muted
- **Input**: 
  - Background: `bg-surface-dark`
  - Border: `border border-surface-border`
  - Padding: `px-4 py-3`
  - Border Radius: `rounded-lg`
  - Focus: Primary border, glow
  - Error: Red border

##### Dropdowns
- **Style**: Custom select
- **Same styling as inputs**
- **Icon**: Dropdown arrow (Material Symbol)

##### Text Areas
- **Min Height**: 100px
- **Resize**: Vertical only
- **Same styling as inputs**

##### File Upload
- **Area**: Drag and drop zone
- **Border**: Dashed, primary color
- **Background**: `bg-surface-dark`
- **Padding**: `p-8`
- **Text**: "Click to upload or drag and drop"
- **Preview**: Grid of uploaded images
- **Crop Tool**: Modal with cropper

##### Buttons
- **Save**: Primary, full width or right-aligned
- **Cancel**: Outlined, secondary
- **Spacing**: `gap-4`

#### Validation
- **Error Messages**: Below input, red text, small
- **Success Indicators**: Green checkmark
- **Required Fields**: Asterisk (*) red

### 8. Messages Page

#### Layout
- **Sidebar**: Fixed left
- **Main Content**: Split view (desktop) or stacked (mobile)

#### Left Panel: Conversations List
- **Width**: 400px (desktop), full width (mobile)
- **Background**: `bg-surface-dark`
- **Border**: `border-r border-surface-border`
- **Height**: 100vh

##### Search Bar
- **Position**: Top
- **Input**: Full width, rounded, muted background
- **Icon**: Search icon (left)
- **Placeholder**: "Search conversations"

##### Conversations
- **Layout**: Vertical list
- **Item Style**:
  - Padding: `p-4`
  - Border Bottom: `border-b border-surface-border`
  - Hover: `bg-[#392b28]`
  - Active: Primary background tint

- **Item Content**:
  - **Left**: Profile Image (48px, circular)
  - **Center**: 
    - Name (Bold)
    - Last Message Preview (Muted, truncated)
    - Timestamp (Small, right-aligned)
  - **Right**: 
    - Unread Badge (Red, circular, if unread)
    - Online Indicator (Green dot, if online)

#### Right Panel: Chat Interface
- **Width**: Auto (flex)
- **Background**: `bg-background-dark`

##### Chat Header
- **Height**: 64px
- **Background**: `bg-surface-dark`
- **Border**: `border-b border-surface-border`
- **Padding**: `px-6 py-4`
- **Content**:
  - Profile Image (40px, circular, left)
  - Name, Online Status (center)
  - Actions Menu (right): 3-dot menu
    - View Profile
    - Report User
    - Block User

##### Messages Area
- **Height**: Calc(100vh - 128px)
- **Padding**: `p-6`
- **Overflow**: Auto (scrollable)
- **Background**: `bg-background-dark`

##### Message Bubbles
- **Sent Messages** (Right-aligned):
  - Background: Primary color
  - Text: White
  - Border Radius: `rounded-2xl rounded-tr-sm` (top-right sharp)
  - Max Width: 70%
  - Padding: `px-4 py-2`
  - Margin: `mb-2`
  - Timestamp: Small, below, right-aligned

- **Received Messages** (Left-aligned):
  - Background: `bg-surface-dark`
  - Text: White
  - Border: `border border-surface-border`
  - Border Radius: `rounded-2xl rounded-tl-sm` (top-left sharp)
  - Max Width: 70%
  - Padding: `px-4 py-2`
  - Margin: `mb-2`
  - Timestamp: Small, below, left-aligned

- **Read Receipt**: Checkmark icon (double for read)
- **Time**: Small, muted, below message

##### Input Area
- **Height**: 64px
- **Background**: `bg-surface-dark`
- **Border**: `border-t border-surface-border`
- **Padding**: `px-6 py-4`
- **Layout**: Flex, items-center

- **Components**:
  - **Text Input**: 
    - Flex-1
    - Background: `bg-background-dark`
    - Border: `border border-surface-border`
    - Padding: `px-4 py-2`
    - Border Radius: `rounded-full`
    - Placeholder: "Type a message..."
    - Max Height: 120px (multiline)
  
  - **Send Button**:
    - Icon: `send` (Material Symbol)
    - Size: 40px
    - Background: Primary
    - Border Radius: `rounded-full`
    - Disabled: Muted when empty

#### Mobile View
- **Conversations**: Full screen list
- **Chat**: Full screen, back button to conversations
- **Input**: Fixed bottom, above keyboard

### 9. Requests Page

#### Layout
- **Sidebar**: Fixed left
- **Main Content**: List or grid

#### Tabs
- **Incoming Requests** (Default)
- **Sent Requests**
- **Style**: Underline tabs, primary color active

#### Request Cards

##### Incoming Request Card
- **Layout**: Horizontal card
- **Background**: `bg-surface-dark`
- **Border**: `border border-surface-border`
- **Border Radius**: `rounded-xl`
- **Padding**: `p-6`
- **Margin**: `mb-4`

- **Content**:
  - **Left**: Profile Image (120x120px, circular)
  - **Center**: 
    - Name (Bold, large)
    - Age, Location (Muted)
    - Education, Occupation (Small)
    - Sent: "X days ago" (Muted, small)
  - **Right**: 
    - Action Buttons:
      - "Accept" (Primary, full width)
      - "Decline" (Outlined, red, full width)
    - Spacing: `gap-2`

##### Sent Request Card
- **Same layout as incoming**
- **Status Badge**: 
  - "Pending" (Yellow)
  - "Accepted" (Green)
  - "Declined" (Red)
- **Action**: "Cancel Request" (if pending)

#### Empty State
- **Icon**: Mail icon (large, muted)
- **Text**: "No requests yet"
- **Subtext**: "When someone sends you an interest, it will appear here"

### 10. Shortlist Page

#### Layout
- **Sidebar**: Fixed left
- **Main Content**: Grid

#### Header
- **Title**: "My Shortlist"
- **Count**: "X profiles"
- **Actions**: "Clear All" (if items exist)

#### Grid View
- **Layout**: Same as Matches page
- **Card**: Same styling
- **Actions**:
  - "View Profile"
  - "Remove from Shortlist" (Red, outlined)

#### Empty State
- **Icon**: Bookmark icon (large, muted)
- **Text**: "Your shortlist is empty"
- **Subtext**: "Start adding profiles to your shortlist"
- **CTA**: "Browse Matches"

### 11. Notifications Page

#### Layout
- **Sidebar**: Fixed left
- **Main Content**: Two-column (desktop) or single (mobile)

#### Left Column: Notifications Feed
- **Width**: 66.67% (desktop)
- **Max Width**: 800px

##### Header
- **Title**: "Notifications"
- **Actions**: 
  - "Mark All as Read" (Button, right)
  - Filter Dropdown (All, Matches, Interests, Messages, Views)

##### Notification List
- **Layout**: Vertical list
- **Item Style**:
  - Background: `bg-surface-dark` (unread) or transparent (read)
  - Border: `border-b border-surface-border`
  - Padding: `p-4`
  - Hover: `bg-[#392b28]`

- **Item Content**:
  - **Left**: 
    - Icon (Material Symbol, 40px, colored)
    - Background: Colored circle (muted)
  - **Center**:
    - Message (Bold if unread)
    - Timestamp (Small, muted, relative)
    - Related User Info (if applicable)
  - **Right**:
    - Unread Indicator (Red dot, if unread)
    - Action Button (if applicable)

##### Notification Types
- **Interest**: Heart icon, red
- **Interest Accepted**: Heart with check, green
- **Message**: Chat icon, blue
- **Match**: Star icon, yellow
- **Profile View**: Eye icon, gray

#### Right Column: Alert Settings
- **Width**: 33.33% (desktop)
- **Position**: Sticky top

##### Settings Card
- **Background**: `bg-surface-dark`
- **Border**: `border border-surface-border`
- **Border Radius**: `rounded-xl`
- **Padding**: `p-6`

##### Sections
1. **Email Notifications**
   - Toggle switches for:
     - New Matches
     - Messages
     - Profile Views
   - Style: Custom toggle (primary color)

2. **SMS Notifications**
   - Toggle switches for:
     - Received Interest
     - Security Alerts
   - Same toggle style

3. **Digest Frequency**
   - Radio buttons:
     - Instant
     - Daily
     - Weekly
   - Selected: Primary color

4. **Go Premium Card**
   - Background: Gradient (primary)
   - Text: White
   - CTA: "Upgrade Now"
   - Border Radius: `rounded-xl`
   - Padding: `p-6`

#### Empty State
- **Icon**: Bell icon (large, muted)
- **Text**: "No notifications"
- **Subtext**: "You're all caught up!"

### 12. Membership/Plans Page

#### Layout
- **Sidebar**: Fixed left (if logged in)
- **Top Navbar**: If logged out
- **Main Content**: Centered, max-width 1200px

#### Header
- **Title**: "Choose Your Plan"
- **Subtitle**: "Select the perfect plan for your journey"

#### Plans Grid
- **Layout**: 3-column grid (desktop), 2-column (tablet), 1-column (mobile)
- **Spacing**: `gap-6`

##### Plan Card
- **Background**: `bg-surface-dark`
- **Border**: `border-2` (primary if featured)
- **Border Radius**: `rounded-2xl`
- **Padding**: `p-8`
- **Height**: Auto (flex column)

- **Featured Badge** (if featured):
  - Position: Top center
  - Background: Primary color
  - Text: "MOST POPULAR" (from badge field)
  - Padding: `px-4 py-2`
  - Border Radius: `rounded-full`
  - Font: Small, bold, white

- **Content**:
  - **Plan Name**: Large, bold, white
  - **Price**: 
    - Amount: `text-4xl font-black`
    - Currency: "₹" prefix
    - Period: "/month" (small, muted)
  - **Description**: Muted text, 2-3 lines
  - **Features List**:
    - Icon: Checkmark (green)
    - Text: Feature item
    - Spacing: `gap-2`
  - **CTA Button**:
    - Full width
    - Primary background (or outlined if current plan)
    - Text: "Subscribe" or "Current Plan"
    - Disabled if current plan

#### Comparison Table
- **Layout**: Full width table
- **Style**: 
  - Background: `bg-surface-dark`
  - Border: `border border-surface-border`
  - Border Radius: `rounded-xl`
- **Columns**: Plan names + Features
- **Rows**: Feature names + Checkmarks/X marks
- **Header**: Sticky, primary background

#### Footer Note
- **Text**: Terms and conditions
- **Links**: Terms page, Privacy policy
- **Style**: Small, muted, centered

### 13. Search Page

#### Layout
- **Sidebar**: Fixed left
- **Main Content**: Same as Matches page

#### Advanced Filters
- **Layout**: Collapsible section
- **Background**: `bg-surface-dark`
- **Border**: `border border-surface-border`
- **Border Radius**: `rounded-xl`
- **Padding**: `p-6`

##### Filter Groups
1. **Basic Filters**
   - Age Range (Dual slider)
   - Gender (Radio buttons)
   - Location (Cascading dropdowns)

2. **Education & Career**
   - Highest Education (Multi-select)
   - Occupation (Multi-select)
   - Annual Income (Range)

3. **Physical Attributes**
   - Height Range (Dual slider)
   - Weight Range (Dual slider)

4. **Personal Details**
   - Marital Status (Checkboxes)
   - Mother Tongue (Multi-select)
   - Caste (Multi-select)

5. **Astrological**
   - Raashi (Multi-select)
   - Nakshtra (Multi-select)

##### Filter Actions
- **Apply Filters**: Primary button
- **Reset**: Outlined button
- **Clear All**: Text button, red

#### Results
- **Same as Matches page grid/list view**
- **Sort Options**: 
  - Dropdown: "Sort by"
  - Options: Relevance, Age, Recently Joined

### 14. Report User Page

#### Layout
- **Modal or Full Page**
- **Max Width**: 600px (if modal)
- **Centered**

#### Form
- **Title**: "Report User"
- **Subtitle**: User name and profile image

##### Report Reason
- **Type**: Radio buttons or dropdown
- **Options**:
  - Spam/Scam
  - Harassment
  - Inappropriate Photos
  - Underage
  - Other

##### Details
- **Type**: Textarea
- **Label**: "Additional Details"
- **Placeholder**: "Please provide more information..."
- **Min Height**: 120px

##### Block User
- **Type**: Checkbox
- **Label**: "Block this user"
- **Subtext**: "You won't see this user's profile or receive messages from them"

##### Actions
- **Submit**: Primary button, "Submit Report"
- **Cancel**: Outlined button

---

## Component Library

### Buttons

#### Primary Button
- **Background**: Primary color (#ec3713)
- **Text**: White
- **Padding**: `px-6 py-3` (medium) or `px-8 py-4` (large)
- **Border Radius**: `rounded-lg` or `rounded-full`
- **Font**: Medium weight, base size
- **Hover**: Darker primary, glow effect
- **Disabled**: Muted background, no interaction

#### Secondary Button
- **Background**: Transparent
- **Border**: 2px solid primary
- **Text**: Primary color
- **Same padding and radius**
- **Hover**: Primary background, white text

#### Outlined Button
- **Background**: Transparent
- **Border**: 1px solid surface-border
- **Text**: White
- **Same padding and radius**
- **Hover**: Surface-dark background

#### Text Button
- **Background**: Transparent
- **Text**: Primary color or white
- **Padding**: `px-4 py-2`
- **Hover**: Underline or background tint

#### Icon Button
- **Size**: 40px (square)
- **Background**: Surface-dark or primary
- **Border Radius**: `rounded-full`
- **Icon**: Material Symbol, 24px
- **Hover**: Scale up slightly

### Input Fields

#### Text Input
- **Background**: `bg-surface-dark`
- **Border**: `border border-surface-border`
- **Padding**: `px-4 py-3`
- **Border Radius**: `rounded-lg`
- **Text**: White
- **Placeholder**: Muted text
- **Focus**: Primary border, glow
- **Error**: Red border, error message below

#### Textarea
- **Same as text input**
- **Min Height**: 100px
- **Resize**: Vertical only

#### Select/Dropdown
- **Same styling as text input**
- **Icon**: Dropdown arrow (right)
- **Custom styling** (not native select)

#### Checkbox
- **Size**: 20px
- **Border**: 2px solid surface-border
- **Checked**: Primary background, white checkmark
- **Label**: Left of checkbox, clickable

#### Radio Button
- **Size**: 20px
- **Border**: 2px solid surface-border
- **Checked**: Primary background, white dot
- **Label**: Right of radio, clickable

#### Toggle Switch
- **Width**: 48px
- **Height**: 24px
- **Background**: Surface-border (off), Primary (on)
- **Thumb**: White circle, 20px
- **Animation**: Smooth slide

### Cards

#### Basic Card
- **Background**: `bg-surface-dark`
- **Border**: `border border-surface-border`
- **Border Radius**: `rounded-xl`
- **Padding**: `p-6`
- **Shadow**: Subtle (optional)

#### Profile Card
- **Image**: Top, aspect ratio 4:5
- **Content**: Below image
- **Actions**: Bottom, full width buttons
- **Hover**: Scale up, shadow

#### Stats Card
- **Icon**: Top left, colored
- **Number**: Large, bold, center
- **Label**: Below number, muted
- **Background**: Gradient or solid

### Badges

#### Status Badge
- **Size**: Small
- **Padding**: `px-2 py-1`
- **Border Radius**: `rounded-full`
- **Font**: Small, bold
- **Colors**:
  - Success: Green background, white text
  - Error: Red background, white text
  - Warning: Yellow background, black text
  - Info: Blue background, white text

#### Count Badge
- **Size**: 20px (circular)
- **Background**: Primary color
- **Text**: White, small, bold
- **Position**: Top right of parent

### Modals

#### Modal Overlay
- **Background**: `rgba(0, 0, 0, 0.75)`
- **Position**: Fixed, full screen
- **Z-index**: 100
- **Animation**: Fade in

#### Modal Content
- **Background**: `bg-surface-dark`
- **Border Radius**: `rounded-2xl`
- **Max Width**: 600px (medium), 800px (large)
- **Padding**: `p-6`
- **Position**: Centered
- **Animation**: Scale in

#### Modal Header
- **Title**: Large, bold
- **Close Button**: Top right, X icon
- **Border Bottom**: Surface-border

#### Modal Body
- **Padding**: `py-4`
- **Content**: Form or content

#### Modal Footer
- **Border Top**: Surface-border
- **Padding**: `pt-4`
- **Actions**: Right-aligned buttons

### Alerts

#### Success Alert
- **Background**: `bg-green-500/20`
- **Border**: `border border-green-500`
- **Text**: Green-300
- **Icon**: Checkmark (left)
- **Padding**: `px-4 py-3`
- **Border Radius**: `rounded-lg`

#### Error Alert
- **Background**: `bg-red-500/20`
- **Border**: `border border-red-500`
- **Text**: Red-300
- **Icon**: Error icon (left)

#### Warning Alert
- **Background**: `bg-yellow-500/20`
- **Border**: `border border-yellow-500`
- **Text**: Yellow-300

#### Info Alert
- **Background**: `bg-blue-500/20`
- **Border**: `border border-blue-500`
- **Text**: Blue-300

### Loading Indicators

#### Spinner
- **Size**: 40px
- **Color**: Primary
- **Animation**: Rotate
- **Style**: Circular, dashed border

#### Skeleton Loader
- **Background**: Surface-dark
- **Shimmer**: Animated gradient
- **Shape**: Matches content (text, image, card)

#### Progress Bar
- **Background**: Surface-border
- **Fill**: Primary color
- **Height**: 4px
- **Border Radius**: `rounded-full`
- **Animation**: Smooth fill

### Tooltips

#### Tooltip
- **Background**: Surface-dark
- **Text**: White, small
- **Padding**: `px-3 py-2`
- **Border Radius**: `rounded-lg`
- **Arrow**: Small triangle
- **Position**: Above or below element
- **Z-index**: 200

### Dropdowns

#### Dropdown Menu
- **Background**: `bg-surface-dark`
- **Border**: `border border-surface-border`
- **Border Radius**: `rounded-lg`
- **Padding**: `py-2`
- **Shadow**: Large
- **Items**: 
  - Padding: `px-4 py-2`
  - Hover: Surface-border background
  - Divider: Border-bottom between groups

---

## User Flows

### 1. Registration Flow

```
Home Page
  ↓ (Click "Sign Up")
Signup Page - Step 1 (Basic Info)
  ↓ (Fill form, click "Next")
Signup Page - Step 2 (Personal Details)
  ↓ (Fill form, click "Next")
Signup Page - Step 3 (Astrological)
  ↓ (Fill form, click "Next")
Signup Page - Step 4 (Location)
  ↓ (Fill form, click "Next")
Signup Page - Step 5 (Education & Career)
  ↓ (Fill form, click "Next")
Signup Page - Step 6 (Additional Details)
  ↓ (Fill form, click "Next")
Signup Page - Step 7 (Profile Photo)
  ↓ (Upload photo, click "Complete")
Email Verification (if required)
  ↓
Dashboard (Welcome screen)
```

### 2. Login Flow

```
Home Page / Login Page
  ↓ (Enter credentials)
Login Form
  ↓ (Submit)
  ├─ Success → Dashboard
  ├─ Error → Show error message, stay on page
  └─ Google OAuth → Google Auth → Callback → Dashboard
```

### 3. Match Discovery Flow

```
Dashboard
  ↓ (Click "View Matches" or "Matches" in nav)
Matches Page
  ↓ (Browse profiles)
Profile Card
  ↓ (Click "View Profile")
Profile View Page
  ↓ (Click "Send Interest")
Interest Sent Confirmation
  ↓ (Back to Matches or wait for response)
```

### 4. Interest Acceptance Flow

```
Dashboard / Notifications
  ↓ (See "New Interest" notification)
Requests Page
  ↓ (View incoming request)
Request Card
  ↓ (Click "Accept")
Interest Accepted
  ├─ Notification sent to sender
  ├─ Connection established
  └─ Can now message each other
```

### 5. Messaging Flow

```
Messages Page (Conversations List)
  ↓ (Click conversation)
Chat Interface
  ↓ (Type message, click send)
Message Sent
  ↓ (Real-time update)
New Message Received
  ↓ (Notification + real-time update)
Read Receipt
```

### 6. Profile Edit Flow

```
Dashboard / Profile Menu
  ↓ (Click "Edit Profile")
Edit Profile Page
  ↓ (Navigate through tabs/sections)
  ├─ Basic Information
  ├─ Personal Details
  ├─ Astrological Details
  ├─ Location
  ├─ Education & Career
  ├─ Additional Information
  └─ Photos
  ↓ (Click "Save")
Profile Updated
  ↓ (Success message)
Dashboard / Profile View
```

### 7. Membership Purchase Flow

```
Membership Page
  ↓ (Browse plans)
Plan Card
  ↓ (Click "Subscribe")
Payment Modal / Checkout
  ↓ (Enter payment details)
Payment Processing
  ├─ Success → Membership Activated → Dashboard
  └─ Error → Show error, retry
```

### 8. Search Flow

```
Matches Page / Search Page
  ↓ (Click "Advanced Filters")
Filters Panel
  ↓ (Select filters, click "Apply")
Filtered Results
  ↓ (Browse, click profile)
Profile View
```

---

## Responsive Design

### Breakpoints

- **Mobile**: < 640px (sm)
- **Tablet**: 640px - 1024px (md, lg)
- **Desktop**: > 1024px (xl, 2xl)

### Mobile Adaptations

#### Navigation
- **Sidebar**: Hidden, replaced with hamburger menu
- **Bottom Nav**: Fixed bottom navigation bar
- **Top Nav**: Simplified, logo + menu icon

#### Layout
- **Grids**: 1 column (mobile), 2 columns (tablet), 3+ columns (desktop)
- **Cards**: Full width (mobile), responsive (tablet+)
- **Forms**: Stacked inputs (mobile), side-by-side (desktop)

#### Typography
- **Headings**: Scale down on mobile
- **Body Text**: Same size, adjust line height
- **Buttons**: Full width (mobile), auto (desktop)

#### Images
- **Profile Images**: Smaller on mobile
- **Hero Images**: Full width, maintain aspect ratio
- **Gallery**: 2 columns (mobile), 3+ (desktop)

#### Modals
- **Full Screen**: On mobile
- **Centered**: On desktop
- **Padding**: Reduced on mobile

#### Messages
- **Split View**: Desktop (list + chat)
- **Stacked View**: Mobile (list → chat on tap)

### Tablet Adaptations

#### Layout
- **Sidebar**: Collapsible or always visible
- **Grids**: 2 columns default
- **Cards**: Medium size

#### Navigation
- **Top Nav**: Full navigation visible
- **Sidebar**: Optional, can be toggled

---

## Accessibility Guidelines

### Color Contrast
- **Text on Background**: Minimum 4.5:1 ratio
- **Large Text**: Minimum 3:1 ratio
- **Interactive Elements**: Minimum 3:1 ratio

### Keyboard Navigation
- **Tab Order**: Logical flow
- **Focus Indicators**: Visible outline (primary color)
- **Skip Links**: For main content
- **Keyboard Shortcuts**: Documented

### Screen Readers
- **Alt Text**: All images
- **ARIA Labels**: Buttons, icons, form fields
- **Landmarks**: Header, nav, main, footer
- **Headings**: Proper hierarchy (h1 → h2 → h3)

### Form Accessibility
- **Labels**: Associated with inputs
- **Error Messages**: Linked to fields
- **Required Fields**: Clearly marked
- **Help Text**: Available for complex fields

### Interactive Elements
- **Button Size**: Minimum 44x44px touch target
- **Link Size**: Minimum 44px height
- **Hover States**: Not required for functionality
- **Focus States**: Always visible

### Content
- **Text Alternatives**: For icons and images
- **Descriptive Links**: Not just "Click here"
- **Error Messages**: Clear and actionable
- **Loading States**: Announced to screen readers

---

## Animation & Transitions

### Page Transitions
- **Duration**: 300ms
- **Easing**: `ease-in-out`
- **Type**: Fade + slide

### Hover Effects
- **Buttons**: Scale (1.05x), glow
- **Cards**: Scale (1.02x), shadow increase
- **Links**: Underline, color change
- **Duration**: 200ms

### Loading Animations
- **Spinner**: Rotate, 1s linear, infinite
- **Skeleton**: Shimmer, 1.5s ease-in-out, infinite
- **Progress**: Smooth fill, 500ms ease-out

### Modal Animations
- **Overlay**: Fade in, 200ms
- **Content**: Scale in + fade, 300ms
- **Exit**: Reverse animation

### Message Animations
- **Send**: Slide in from right, fade
- **Receive**: Slide in from left, fade
- **Duration**: 300ms

### Notification Animations
- **Appear**: Slide down + fade, 400ms
- **Dismiss**: Slide up + fade, 300ms
- **Badge Update**: Pulse, 200ms

### Scroll Animations
- **Fade In**: On scroll into view
- **Duration**: 600ms
- **Offset**: 50px from viewport

---

## Loading States

### Page Load
- **Initial**: Skeleton loaders for main content
- **Progressive**: Load above-fold first
- **Complete**: Fade in content

### Data Fetching
- **Loading**: Spinner or skeleton
- **Empty**: Empty state with message
- **Error**: Error message with retry button

### Form Submission
- **Button**: Loading spinner, disabled
- **Message**: "Processing..." or progress bar
- **Complete**: Success message or redirect

### Image Loading
- **Placeholder**: Blur or solid color
- **Progressive**: Low quality → high quality
- **Error**: Default avatar or error icon

### Infinite Scroll
- **Loading**: Bottom spinner
- **End**: "No more items" message
- **Error**: "Load failed, try again" button

---

## Error States

### Form Errors
- **Inline**: Red text below field
- **Icon**: Error icon next to field
- **Summary**: Top of form (if multiple errors)
- **Focus**: Auto-focus first error field

### Network Errors
- **Message**: "Connection failed. Please check your internet."
- **Action**: Retry button
- **Icon**: Warning or error icon

### 404 Errors
- **Page**: Custom 404 page
- **Message**: "Page not found"
- **Action**: "Go Home" button
- **Illustration**: Optional

### 500 Errors
- **Message**: "Something went wrong"
- **Action**: "Try Again" or "Contact Support"
- **Details**: Technical details (dev mode only)

### Permission Errors
- **Message**: "You don't have permission"
- **Action**: "Go Back" or "Upgrade Plan"
- **Context**: Explain why permission needed

### Validation Errors
- **Real-time**: Show as user types (after blur)
- **Submit**: Show all errors on submit
- **Clear**: Auto-clear on correction

---

## Additional UI Considerations

### Dark Mode
- **Default**: Dark mode
- **Toggle**: Optional (if implemented)
- **Consistency**: All components support dark mode

### Internationalization
- **Languages**: English, Hindi, Gujarati
- **RTL Support**: Not required (LTR only)
- **Date Formats**: Locale-specific
- **Number Formats**: Locale-specific

### Performance
- **Lazy Loading**: Images below fold
- **Code Splitting**: Route-based
- **Caching**: Static assets
- **Optimization**: Compressed images, minified CSS/JS

### Browser Support
- **Modern Browsers**: Chrome, Firefox, Safari, Edge (latest 2 versions)
- **Mobile**: iOS Safari, Chrome Mobile
- **Fallbacks**: Graceful degradation

---

**Document Version**: 1.0  
**Last Updated**: January 2025  
**Maintained By**: TrueUnion Design Team

