# warehouse-attribute-bundle

composer create-project --prefer-dist akeneo/pim-community-standard ./pim-lavoweb "1.5.*@stable" --ignore-platform-reqs

cd pim-lavoweb

composer require lavoweb/warehouse-attribute-bundle

Settings -> Attributes -> Create attribute -> Warehouse

Settings -> Families -> *yours* -> Attributes -> Add attributes