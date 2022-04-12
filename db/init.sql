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
    hardiness_zone_range TEXT NOT NULL
);

INSERT INTO
    entries(id, name_colloquial, name_genus_species, plant_id, exploratory_constructive_play, exploratory_sensory_play, physical_play, imaginative_play, restorative_play, play_with_rules, bio_play, perennial, full_sun, partial_shade, full_shade, hardiness_zone_range)
VALUES
    (1, 'Giant Iron Weed', 'Vernonia gigantea', 'GA_15', 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 0, '5-8');

INSERT INTO
    entries(id, name_colloquial, name_genus_species, plant_id, exploratory_constructive_play, exploratory_sensory_play, physical_play, imaginative_play, restorative_play, play_with_rules, bio_play, perennial, full_sun, partial_shade, full_shade, hardiness_zone_range)
VALUES
    (2, "Lady's Mantle", 'Alchemilla mollis', 'FL_26', 0, 1, 1, 1, 0, 0, 1, 1, 1, 1, 0, '3-8');

INSERT INTO
    entries(id, name_colloquial, name_genus_species, plant_id, exploratory_constructive_play, exploratory_sensory_play, physical_play, imaginative_play, restorative_play, play_with_rules, bio_play, perennial, full_sun, partial_shade, full_shade, hardiness_zone_range)
VALUES
    (3, 'American Cranberry', 'Vaccinium macrocarpon', 'GR_03', 0, 1, 1, 1, 0, 0, 1, 0, 1, 0, 0, '3-6');

INSERT INTO
    entries(id, name_colloquial, name_genus_species, plant_id, exploratory_constructive_play, exploratory_sensory_play, physical_play, imaginative_play, restorative_play, play_with_rules, bio_play, perennial, full_sun, partial_shade, full_shade, hardiness_zone_range)
VALUES
    (4, 'Jostaberry', 'Ribes x nidigrolaria', 'SH_19', 0, 1, 1, 0, 0, 0, 1, 1, 1, 1, 0, '3-8');

INSERT INTO
    entries(id, name_colloquial, name_genus_species, plant_id, exploratory_constructive_play, exploratory_sensory_play, physical_play, imaginative_play, restorative_play, play_with_rules, bio_play, perennial, full_sun, partial_shade, full_shade, hardiness_zone_range)
VALUES
    (5, 'Camperdown Elm', "Ulmus glabra 'Camperdownii'", 'TR_30', 1, 1, 1, 0, 1, 0, 0, 1, 1, 0, 0, '4-6');

INSERT INTO
    entries(id, name_colloquial, name_genus_species, plant_id, exploratory_constructive_play, exploratory_sensory_play, physical_play, imaginative_play, restorative_play, play_with_rules, bio_play, perennial, full_sun, partial_shade, full_shade, hardiness_zone_range)
VALUES
    (6, "Houseleek 'Mahogany'", "Sempervivum rubellum 'Mahogany'", 'GR_09', 0, 1, 0, 1, 0, 0, 1, 1, 1, 1, 0, '5-8');

INSERT INTO
    entries(id, name_colloquial, name_genus_species, plant_id, exploratory_constructive_play, exploratory_sensory_play, physical_play, imaginative_play, restorative_play, play_with_rules, bio_play, perennial, full_sun, partial_shade, full_shade, hardiness_zone_range)
VALUES
    (7, "Hen & Chicks 'Red Lion'", "Sempervivum 'Red Lion'", 'GR_07', 0, 1, 0, 1, 0, 0, 1, 1, 1, 1, 0, '4-7, variable');

INSERT INTO
    entries(id, name_colloquial, name_genus_species, plant_id, exploratory_constructive_play, exploratory_sensory_play, physical_play, imaginative_play, restorative_play, play_with_rules, bio_play, perennial, full_sun, partial_shade, full_shade, hardiness_zone_range)
VALUES
    (8, 'Silky Willow', 'Salix sericea', 'SH_01', 1, 1, 1, 0, 1, 0, 1, 1, 1, 1, 1, '4-8');

INSERT INTO
    entries(id, name_colloquial, name_genus_species, plant_id, exploratory_constructive_play, exploratory_sensory_play, physical_play, imaginative_play, restorative_play, play_with_rules, bio_play, perennial, full_sun, partial_shade, full_shade, hardiness_zone_range)
VALUES
    (9, 'Red Osier Dogwood (Red Twig Dogwood)', 'Cornus sericea', 'SH_29', 0, 1, 1, 0, 0, 1, 1, 1, 1, 1, 0, '3-7');

INSERT INTO
    entries(id, name_colloquial, name_genus_species, plant_id, exploratory_constructive_play, exploratory_sensory_play, physical_play, imaginative_play, restorative_play, play_with_rules, bio_play, perennial, full_sun, partial_shade, full_shade, hardiness_zone_range)
VALUES
    (10, 'River Birch', 'Betula nigra', 'TR_23', 1, 1, 1, 1, 0, 0, 1, 1, 1, 1, 0, '3-9');

INSERT INTO
    entries(id, name_colloquial, name_genus_species, plant_id, exploratory_constructive_play, exploratory_sensory_play, physical_play, imaginative_play, restorative_play, play_with_rules, bio_play, perennial, full_sun, partial_shade, full_shade, hardiness_zone_range)
VALUES
    (11, 'Flowering Raspberry', 'Rubus odoratus', 'SH_33', 0, 1, 1, 0, 0, 0, 1, 1, 1, 1, 1, '4-6');

INSERT INTO
    entries(id, name_colloquial, name_genus_species, plant_id, exploratory_constructive_play, exploratory_sensory_play, physical_play, imaginative_play, restorative_play, play_with_rules, bio_play, perennial, full_sun, partial_shade, full_shade, hardiness_zone_range)
VALUES
    (12, 'Spiked Gay-Feather', 'Liatris spicata', 'FL_05', 0, 1, 1, 0, 0, 0, 1, 1, 1, 1, 0, '3-9');

INSERT INTO
    entries(id, name_colloquial, name_genus_species, plant_id, exploratory_constructive_play, exploratory_sensory_play, physical_play, imaginative_play, restorative_play, play_with_rules, bio_play, perennial, full_sun, partial_shade, full_shade, hardiness_zone_range)
VALUES
    (13, 'Broad-leaf Sedge', 'Carex platyphylla', 'GA_05', 1, 1, 0, 1, 0, 0, 1, 1, 0, 1, 1, '4-9');

INSERT INTO
    entries(id, name_colloquial, name_genus_species, plant_id, exploratory_constructive_play, exploratory_sensory_play, physical_play, imaginative_play, restorative_play, play_with_rules, bio_play, perennial, full_sun, partial_shade, full_shade, hardiness_zone_range)
VALUES
    (14, 'Goat Willow', 'Salix caprea', 'SH_09', 0, 1, 1, 0, 1, 0, 1, 0, 1, 1, 0, '5-8');

INSERT INTO
    entries(id, name_colloquial, name_genus_species, plant_id, exploratory_constructive_play, exploratory_sensory_play, physical_play, imaginative_play, restorative_play, play_with_rules, bio_play, perennial, full_sun, partial_shade, full_shade, hardiness_zone_range)
VALUES
    (15, 'Christmas fern', 'Polystichum acrostichoides', 'FE_12', 0, 1, 0, 1, 0, 0, 1, 1, 0, 1, 1, '3-9');

INSERT INTO
    entries(id, name_colloquial, name_genus_species, plant_id, exploratory_constructive_play, exploratory_sensory_play, physical_play, imaginative_play, restorative_play, play_with_rules, bio_play, perennial, full_sun, partial_shade, full_shade, hardiness_zone_range)
VALUES
    (16, "Harry Lauder's Walking stick", "Corylus avellana 'Contorta'", 'SH_03', 0, 1, 1, 1, 1, 0, 1, 1, 1, 1, 0, '4-8');

CREATE TABLE tags (
    id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
    tag_name TEXT NOT NULL
);

INSERT INTO
    entries(id, tag_name)
VALUES
    (17, 'shrub');

INSERT INTO
    entries(id, tag_name)
VALUES
    (18, 'grass');

INSERT INTO
    entries(id, tag_name)
VALUES
    (19, 'vine');

INSERT INTO
    entries(id, tag_name)
VALUES
    (20, 'tree');

INSERT INTO
    entries(id, tag_name)
VALUES
    (21, 'flower');

INSERT INTO
    entries(id, tag_name)
VALUES
    (22, 'groundcovers');

INSERT INTO
    entries(id, tag_name)
VALUES
    (23, 'other');


CREATE TABLE entry_tags (
    id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
    entry_id INTEGER NOT NULL,
    FOREIGN KEY(entry_id)
        REFERENCES entries(id)
    tag_id INTEGER NOT NULL,
    FOREIGN KEY(tag_id)
        REFERENCES tags(id)
);

INSERT INTO
    entries(id, entry_id, tag_id)
VALUES
    (24, 1, 18);

INSERT INTO
    entries(id, entry_id, tag_id)
VALUES
    (24, 1, 18);

CREATE TABLE users (
    id INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT UNIQUE,
    username TEXT NOT NULL,
    passward TEXT NOT NULL,
);
