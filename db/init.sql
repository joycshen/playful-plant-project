--- users

CREATE TABLE users (
  id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
  name TEXT NOT NULL,
  username TEXT NOT NULL UNIQUE,
  password TEXT NOT NULL
);

-- password: monkey
INSERT INTO
  users (id, name, username, password)
VALUES
  (
    1,
    'Pat',
    'pat',
    '$2y$10$QtCybkpkzh7x5VN11APHned4J8fu78.eFXlyAMmahuAaNcbwZ7FH.'
  );

-- password: monkey
INSERT INTO
  users (id, name, username, password)
VALUES
  (
    2,
    'Abi',
    'abi',
    '$2y$10$QtCybkpkzh7x5VN11APHned4J8fu78.eFXlyAMmahuAaNcbwZ7FH.'
  );


--- Sessions

CREATE TABLE sessions (
  id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
  user_id INTEGER NOT NULL,
  session TEXT NOT NULL UNIQUE,
  last_login TEXT NOT NULL,
  FOREIGN KEY(user_id) REFERENCES users(id)
);


--- Groups

CREATE TABLE groups (
  id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
  name TEXT NOT NULL UNIQUE
);

INSERT INTO
  groups (id, name)
VALUES
  (1, 'admin');


--- Group Admin

CREATE TABLE admins (
  id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
  group_id INTEGER NOT NULL,
  user_id INTEGER NOT NULL,
  FOREIGN KEY(group_id) REFERENCES groups(id),
  FOREIGN KEY(user_id) REFERENCES users(id)
);

-- User 'Pat' is a member of the 'admin' group.
INSERT INTO
  admins (group_id, user_id)
VALUES
  (1, 1);

-- entry table
CREATE TABLE entries (
    id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
    name_colloquial TEXT NOT NULL,
    name_genus_species TEXT NOT NULL,
    plant_id TEXT NOT NULL,
    exploratory_constructive_play INTEGER NOT NULL,
    exploratory_sensory_play INTEGER NOT NULL,
    physical_play INTEGER NOT NULL,
    imaginative_play INTEGER NOT NULL,
    restorative_play INTEGER NOT NULL,
    play_with_rules INTEGER NOT NULL,
    bio_play INTEGER NOT NULL,
    perennial INTEGER NOT NULL,
    full_sun INTEGER NOT NULL,
    partial_shade INTEGER NOT NULL,
    full_shade INTEGER NOT NULL,
    hardiness_zone_range TEXT NOT NULL,
    file_name TEXT,
    img_ext TEXT
);

INSERT INTO
    entries(id, name_colloquial, name_genus_species, plant_id, exploratory_constructive_play, exploratory_sensory_play, physical_play, imaginative_play, restorative_play, play_with_rules, bio_play, perennial, full_sun, partial_shade, full_shade, hardiness_zone_range, file_name, img_ext)
VALUES
    (1, 'Giant Iron Weed', 'Vernonia gigantea', 'GA_15', 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 0, '5-8', 'placeholder', 'jpg');

INSERT INTO
    entries(id, name_colloquial, name_genus_species, plant_id, exploratory_constructive_play, exploratory_sensory_play, physical_play, imaginative_play, restorative_play, play_with_rules, bio_play, perennial, full_sun, partial_shade, full_shade, hardiness_zone_range, img_ext)
VALUES
    (2, "Lady's Mantle", 'Alchemilla mollis', 'FL_26', 0, 1, 1, 1, 0, 0, 1, 1, 1, 1, 0, '3-8', 'jpg');

INSERT INTO
    entries(id, name_colloquial, name_genus_species, plant_id, exploratory_constructive_play, exploratory_sensory_play, physical_play, imaginative_play, restorative_play, play_with_rules, bio_play, perennial, full_sun, partial_shade, full_shade, hardiness_zone_range, file_name, img_ext)
VALUES
    (3, 'American Cranberry', 'Vaccinium macrocarpon', 'GR_03', 0, 1, 1, 1, 0, 0, 1, 0, 1, 0, 0, '3-6', 'placeholder', 'jpg');

INSERT INTO
    entries(id, name_colloquial, name_genus_species, plant_id, exploratory_constructive_play, exploratory_sensory_play, physical_play, imaginative_play, restorative_play, play_with_rules, bio_play, perennial, full_sun, partial_shade, full_shade, hardiness_zone_range, file_name, img_ext)
VALUES
    (4, 'Jostaberry', 'Ribes x nidigrolaria', 'SH_19', 0, 1, 1, 0, 0, 0, 1, 1, 1, 1, 0, '3-8', 'placeholder', 'jpg');

INSERT INTO
    entries(id, name_colloquial, name_genus_species, plant_id, exploratory_constructive_play, exploratory_sensory_play, physical_play, imaginative_play, restorative_play, play_with_rules, bio_play, perennial, full_sun, partial_shade, full_shade, hardiness_zone_range, file_name, img_ext)
VALUES
    (5, 'Camperdown Elm', "Ulmus glabra 'Camperdownii'", 'TR_30', 1, 1, 1, 0, 1, 0, 0, 1, 1, 0, 0, '4-6', 'placeholder', 'jpg');

INSERT INTO
    entries(id, name_colloquial, name_genus_species, plant_id, exploratory_constructive_play, exploratory_sensory_play, physical_play, imaginative_play, restorative_play, play_with_rules, bio_play, perennial, full_sun, partial_shade, full_shade, hardiness_zone_range, file_name, img_ext)
VALUES
    (6, "Houseleek 'Mahogany'", "Sempervivum rubellum 'Mahogany'", 'GR_09', 0, 1, 0, 1, 0, 0, 1, 1, 1, 1, 0, '5-8', 'placeholder', 'jpg');

INSERT INTO
    entries(id, name_colloquial, name_genus_species, plant_id, exploratory_constructive_play, exploratory_sensory_play, physical_play, imaginative_play, restorative_play, play_with_rules, bio_play, perennial, full_sun, partial_shade, full_shade, hardiness_zone_range, file_name, img_ext)
VALUES
    (7, "Hen & Chicks 'Red Lion'", "Sempervivum 'Red Lion'", 'GR_07', 0, 1, 0, 1, 0, 0, 1, 1, 1, 1, 0, '4-7, variable', 'placeholder', 'jpg');

INSERT INTO
    entries(id, name_colloquial, name_genus_species, plant_id, exploratory_constructive_play, exploratory_sensory_play, physical_play, imaginative_play, restorative_play, play_with_rules, bio_play, perennial, full_sun, partial_shade, full_shade, hardiness_zone_range, file_name, img_ext)
VALUES
    (8, 'Silky Willow', 'Salix sericea', 'SH_01', 1, 1, 1, 0, 1, 0, 1, 1, 1, 1, 1, '4-8', 'placeholder', 'jpg');

INSERT INTO
    entries(id, name_colloquial, name_genus_species, plant_id, exploratory_constructive_play, exploratory_sensory_play, physical_play, imaginative_play, restorative_play, play_with_rules, bio_play, perennial, full_sun, partial_shade, full_shade, hardiness_zone_range, img_ext)
VALUES
    (9, 'Red Osier Dogwood', 'Cornus sericea', 'SH_29', 0, 1, 1, 0, 0, 1, 1, 1, 1, 1, 0, '3-7', 'jpg');

INSERT INTO
    entries(id, name_colloquial, name_genus_species, plant_id, exploratory_constructive_play, exploratory_sensory_play, physical_play, imaginative_play, restorative_play, play_with_rules, bio_play, perennial, full_sun, partial_shade, full_shade, hardiness_zone_range, img_ext)
VALUES
    (10, 'River Birch', 'Betula nigra', 'TR_23', 1, 1, 1, 1, 0, 0, 1, 1, 1, 1, 0, '3-9', 'jpg');

INSERT INTO
    entries(id, name_colloquial, name_genus_species, plant_id, exploratory_constructive_play, exploratory_sensory_play, physical_play, imaginative_play, restorative_play, play_with_rules, bio_play, perennial, full_sun, partial_shade, full_shade, hardiness_zone_range, img_ext)
VALUES
    (11, 'Flowering Raspberry', 'Rubus odoratus', 'SH_33', 0, 1, 1, 0, 0, 0, 1, 1, 1, 1, 1, '4-6', 'jpg');

INSERT INTO
    entries(id, name_colloquial, name_genus_species, plant_id, exploratory_constructive_play, exploratory_sensory_play, physical_play, imaginative_play, restorative_play, play_with_rules, bio_play, perennial, full_sun, partial_shade, full_shade, hardiness_zone_range, img_ext)
VALUES
    (12, 'Spiked Gay-Feather', 'Liatris spicata', 'FL_05', 0, 1, 1, 0, 0, 0, 1, 1, 1, 1, 0, '3-9', 'jpg');

INSERT INTO
    entries(id, name_colloquial, name_genus_species, plant_id, exploratory_constructive_play, exploratory_sensory_play, physical_play, imaginative_play, restorative_play, play_with_rules, bio_play, perennial, full_sun, partial_shade, full_shade, hardiness_zone_range, img_ext)
VALUES
    (13, 'Broad-leaf Sedge', 'Carex platyphylla', 'GA_05', 1, 1, 0, 1, 0, 0, 1, 1, 0, 1, 1, '4-9', 'jpg');

INSERT INTO
    entries(id, name_colloquial, name_genus_species, plant_id, exploratory_constructive_play, exploratory_sensory_play, physical_play, imaginative_play, restorative_play, play_with_rules, bio_play, perennial, full_sun, partial_shade, full_shade, hardiness_zone_range, img_ext)
VALUES
    (14, 'Goat Willow', 'Salix caprea', 'SH_09', 0, 1, 1, 0, 1, 0, 1, 0, 1, 1, 0, '5-8', 'jpg');

INSERT INTO
    entries(id, name_colloquial, name_genus_species, plant_id, exploratory_constructive_play, exploratory_sensory_play, physical_play, imaginative_play, restorative_play, play_with_rules, bio_play, perennial, full_sun, partial_shade, full_shade, hardiness_zone_range, img_ext)
VALUES
    (15, 'Christmas fern', 'Polystichum acrostichoides', 'FE_12', 0, 1, 0, 1, 0, 0, 1, 1, 0, 1, 1, '3-9', 'jpg');

INSERT INTO
    entries(id, name_colloquial, name_genus_species, plant_id, exploratory_constructive_play, exploratory_sensory_play, physical_play, imaginative_play, restorative_play, play_with_rules, bio_play, perennial, full_sun, partial_shade, full_shade, hardiness_zone_range, img_ext)
VALUES
    (16, "Harry Lauder's Walking stick", "Corylus avellana 'Contorta'", 'SH_03', 0, 1, 1, 1, 1, 0, 1, 1, 1, 1, 0, '4-8', 'jpg');

-- tag table
CREATE TABLE tags (
    id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
    tag_name TEXT NOT NULL
);

INSERT INTO
    tags(id, tag_name)
VALUES
    (1, 'shrub');

INSERT INTO
    tags(id, tag_name)
VALUES
    (2, 'grass');

INSERT INTO
    tags(id, tag_name)
VALUES
    (3, 'vine');

INSERT INTO
    tags(id, tag_name)
VALUES
    (4, 'tree');

INSERT INTO
    tags(id, tag_name)
VALUES
    (5, 'flower');

INSERT INTO
    tags(id, tag_name)
VALUES
    (6, 'groundcovers');

INSERT INTO
    tags(id, tag_name)
VALUES
    (7, 'other');


-- relationship table
CREATE TABLE entry_tags (
    id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
    entry_id INTEGER NOT NULL,
    tag_id INTEGER NOT NULL,
	FOREIGN KEY (entry_id) REFERENCES entries(id),
    FOREIGN KEY (tag_id) REFERENCES tags(id)
);

INSERT INTO
    entry_tags(id, entry_id, tag_id)
VALUES
    (1, 1, 2);

INSERT INTO
    entry_tags(id, entry_id, tag_id)
VALUES
    (2, 2, 5);

INSERT INTO
    entry_tags(id, entry_id, tag_id)
VALUES
    (3, 3, 6);

INSERT INTO
    entry_tags(id, entry_id, tag_id)
VALUES
    (4, 4, 1);

INSERT INTO
    entry_tags(id, entry_id, tag_id)
VALUES
    (5, 5, 4);

INSERT INTO
    entry_tags(id, entry_id, tag_id)
VALUES
    (6, 6, 6);

INSERT INTO
    entry_tags(id, entry_id, tag_id)
VALUES
    (7, 7, 6);

INSERT INTO
    entry_tags(id, entry_id, tag_id)
VALUES
    (8, 8, 1);

INSERT INTO
    entry_tags(id, entry_id, tag_id)
VALUES
    (9, 9, 1);

INSERT INTO
    entry_tags(id, entry_id, tag_id)
VALUES
    (10, 10, 4);

INSERT INTO
    entry_tags(id, entry_id, tag_id)
VALUES
    (11, 11, 1);

INSERT INTO
    entry_tags(id, entry_id, tag_id)
VALUES
    (12, 12, 5);

INSERT INTO
    entry_tags(id, entry_id, tag_id)
VALUES
    (13, 13, 2);

INSERT INTO
    entry_tags(id, entry_id, tag_id)
VALUES
    (14, 14, 1);

INSERT INTO
    entry_tags(id, entry_id, tag_id)
VALUES
    (15, 15, 7);

INSERT INTO
    entry_tags(id, entry_id, tag_id)
VALUES
    (16, 16, 1);
