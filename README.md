# Basis23 Ämtliplan

## Backend

### Models

- Ämtli
    - id
    - name
    - slug
    - group
- Group
    - id
    - name
    - slug
- Participants
    - id 
    - name
    - group

### Beziehungen

Ämtli <=> Group
- a Group **hasOne** Ämtli
- a Ämtli **belongsTo** a Group

Group <=> Participants
- a Group **hasMany** Participants
- a Participant **belongsTo** a Group


