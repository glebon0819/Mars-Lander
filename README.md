# Mars-Lander
This repository contains my solutions for the Codingame Mars Lander challenges. These challenges require you to program the guidance system of a hypothetical Mars Lander. The end goal is to land the lander in the correct location while also meeting certain constraints (vertical and horizontal impact speeds must be below certain values). Below is some information about the challenge and how I solved it.
___
## Objective
The objective of the exercise is to create a basic guidance system for a Mars Lander that guides the craft to the landing area in a two-dimensional space and safely lands it within the constraints.

## Variables
- **Constraints to be Met:** 
  - **Vertical Speed** must be >= -40 m/s on impact
  - **Horizontal Speed** must be >= -20 m/s and <= 20 m/s on impact
  - **X Position:** must stay between 0 and 7000 (the width of the zone)
  - **Y Position:** must stay between 0 and 3000 (the height of the zone)
- **Gravitational Acceleration:** -3.711 (m/s^2)
- **Topography:** the surface of Mars is represented by a line that changes directions at various points to indicate the terrain. You are given the coordinates of these points. These can be analyzed to help steer the craft toward or away from certain points.
- **Landing Zone:** varies - coordinates are not directly given. They have to be deduced by the craft by analyzing the topography.
- **Lander Data:** more information below. This data can be used to determine the current statis of 

### Lander Properties
- **Mass:** 1 kg (Presumed; Not specified)
- **Fuel:** varies (between 500 and 1000 (L (presumed)))
- **Thrust Capabilities:** 0 to 4 (N) (integer)
- **X Position:** 0 to 7000 (m) (integer)
- **Y Position:** 0 to 3000 (m) (integer)
- **Angle:** -90 to 90 (degrees)
## Useful Data
### Thrust
| Thrust (N (presumed)) | Lander Acceleration (m/s^2) (w/ gravity) | Fuel Consumption (L/s (presumed)) |
| --------------------- | ---------------------------------------- | --------------------------------- |
| 4                     | +0.289                                   | 4                                 |
| 3                     | -0.711                                   | 3                                 |
| 2                     | -1.711                                   | 2                                 |
| 1                     | -2.711                                   | 1                                 |

```javascript
yThrust = Thrust * cos(|angle|)
xThrust = Thrust * sin(|angle|)
```
