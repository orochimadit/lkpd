---
name: Primary Learning System
colors:
  surface: '#fbf8fd'
  surface-dim: '#dbd9dd'
  surface-bright: '#fbf8fd'
  surface-container-lowest: '#ffffff'
  surface-container-low: '#f5f3f7'
  surface-container: '#efedf1'
  surface-container-high: '#e9e7ec'
  surface-container-highest: '#e4e2e6'
  on-surface: '#1b1b1f'
  on-surface-variant: '#45464f'
  inverse-surface: '#303034'
  inverse-on-surface: '#f2f0f4'
  outline: '#757680'
  outline-variant: '#c5c6d0'
  surface-tint: '#4d5d8b'
  primary: '#021541'
  on-primary: '#ffffff'
  primary-container: '#1a2b56'
  on-primary-container: '#8393c5'
  inverse-primary: '#b5c5f9'
  secondary: '#0060ac'
  on-secondary: '#ffffff'
  secondary-container: '#68abff'
  on-secondary-container: '#003e73'
  tertiary: '#15191b'
  on-tertiary: '#ffffff'
  tertiary-container: '#2a2d30'
  on-tertiary-container: '#919497'
  error: '#ba1a1a'
  on-error: '#ffffff'
  error-container: '#ffdad6'
  on-error-container: '#93000a'
  primary-fixed: '#dae1ff'
  primary-fixed-dim: '#b5c5f9'
  on-primary-fixed: '#051944'
  on-primary-fixed-variant: '#354572'
  secondary-fixed: '#d4e3ff'
  secondary-fixed-dim: '#a4c9ff'
  on-secondary-fixed: '#001c39'
  on-secondary-fixed-variant: '#004883'
  tertiary-fixed: '#e0e3e6'
  tertiary-fixed-dim: '#c4c7ca'
  on-tertiary-fixed: '#191c1e'
  on-tertiary-fixed-variant: '#44474a'
  background: '#fbf8fd'
  on-background: '#1b1b1f'
  surface-variant: '#e4e2e6'
typography:
  headline-xl:
    fontFamily: Plus Jakarta Sans
    fontSize: 40px
    fontWeight: '800'
    lineHeight: 52px
    letterSpacing: -0.02em
  headline-lg:
    fontFamily: Plus Jakarta Sans
    fontSize: 32px
    fontWeight: '700'
    lineHeight: 40px
  headline-lg-mobile:
    fontFamily: Plus Jakarta Sans
    fontSize: 24px
    fontWeight: '700'
    lineHeight: 32px
  body-large:
    fontFamily: Be Vietnam Pro
    fontSize: 18px
    fontWeight: '400'
    lineHeight: 28px
  body-main:
    fontFamily: Be Vietnam Pro
    fontSize: 16px
    fontWeight: '400'
    lineHeight: 24px
  label-bold:
    fontFamily: Plus Jakarta Sans
    fontSize: 14px
    fontWeight: '700'
    lineHeight: 20px
  button-text:
    fontFamily: Plus Jakarta Sans
    fontSize: 16px
    fontWeight: '600'
    lineHeight: 24px
rounded:
  sm: 0.25rem
  DEFAULT: 0.5rem
  md: 0.75rem
  lg: 1rem
  xl: 1.5rem
  full: 9999px
spacing:
  base: 8px
  xs: 4px
  sm: 12px
  md: 24px
  lg: 48px
  gutter: 24px
  margin-mobile: 16px
  margin-desktop: 64px
---

## Brand & Style

The design system is engineered for primary school students, focusing on a "Professional yet Playful" personality. It balances the credibility of an educational tool with the approachability required for young learners. The style is **Modern Corporate for Kids**, utilizing high-clarity layouts, generous whitespace, and tactile elements that encourage interaction without overstimulating the user.

The aesthetic prioritizes cognitive ease. By using a "Soft Professional" approach, we ensure that the interface feels like a reliable learning companion rather than a toy. Visual cues are explicit, and the hierarchy is strictly maintained to help children navigate complex educational content with confidence.

## Colors

The palette is anchored in a deep, professional navy (Primary) to provide an authoritative structure for navigation and headers. A vibrant, friendly blue (Secondary) is used for interactive elements, guiding the child's eye toward "clickable" areas.

The background uses a soft, off-white grey (Tertiary) to reduce eye strain during long reading sessions. All text maintains a high contrast ratio against the background. Success and accent colors are derived from a natural palette (forest greens and soft ambers) to provide positive reinforcement without appearing aggressive.

## Typography

This design system utilizes **Plus Jakarta Sans** for headings to provide a friendly, open-curved geometric feel that is highly legible for young readers. For body text, **Be Vietnam Pro** is used due to its contemporary proportions and excellent readability in dense educational modules.

The type scale is intentionally larger than standard SaaS applications to accommodate developing motor and cognitive skills. Line heights are generous (1.5x minimum) to prevent "line jumping" while reading. We avoid all-caps for long strings of text, reserving them only for short, high-contrast labels.

## Layout & Spacing

The layout follows a **Fluid Grid** model with a strict 8px baseline. This ensures that all components align rhythmically, creating a sense of order that reduces cognitive load.

- **Desktop:** 12-column grid, 1140px max-width, 24px gutters.
- **Tablet:** 8-column grid, 24px margins.
- **Mobile:** 4-column grid, 16px margins, fluid gutters.

Spacing "safe zones" are emphasized around interactive buttons to prevent accidental clicks. Vertical rhythm is maintained by using the `md` (24px) unit for spacing between related content blocks and the `lg` (48px) unit for distinct sections.

## Elevation & Depth

To keep the UI clean but interactive, this design system uses **Tonal Layers** combined with **Ambient Shadows**.

1.  **Level 0 (Base):** The tertiary background color (#F5F7FA).
2.  **Level 1 (Cards/Content):** White surfaces with a very soft, diffused shadow (10% opacity primary color tint, 8px blur) to make learning modules feel like they are sitting on top of the page.
3.  **Level 2 (Interactive/Buttons):** These use a more pronounced shadow and subtle inner-glow to suggest "pressability."

We avoid complex gradients or glassmorphism to ensure that the focus remains entirely on the educational content. Depth is used exclusively to signify hierarchy and interactivity.

## Shapes

The shape language is defined as **Rounded (Level 2)**. This approach eliminates sharp corners which can feel "harsh" or "too adult," replacing them with friendly 8px (0.5rem) base radiuses.

- **Standard Components:** 8px radius.
- **Cards/Containers:** 16px (1rem) radius.
- **Large Action Containers:** 24px (1.5rem) radius.

Icons should follow this logic, using rounded terminals and soft corners to match the UI componentry.

## Components

### Buttons
Primary buttons use the Secondary Blue (#4A90E2) with white text. They feature a 2px bottom "border-shade" of a darker blue to give a tactile, clickable feel. Secondary buttons use a primary-colored outline.

### Input Fields
Fields must have a minimum height of 48px for easy tapping/clicking. They use a light grey stroke that thickens and turns Secondary Blue when focused.

### Cards & Modules
Content modules are housed in white cards with a 16px corner radius. Every card should have a clear "Header" area with a background tint to separate titles from body content.

### Navigation (E-Modul Specific)
- **Progress Bar:** A thick, rounded bar at the top of the screen using the primary blue for the track and the accent green for completion.
- **Prev/Next Toggles:** Large, circular buttons (min 56x56px) positioned at the bottom corners, using icons + text labels for maximum clarity.
- **Badges/Chips:** Used for "Points," "Correct," or "Topic Labels," utilizing the secondary color with 20% opacity as the background.

### Checkboxes & Radios
Larger than standard (24x24px) to accommodate younger users' precision. They use the Primary Blue for active states.