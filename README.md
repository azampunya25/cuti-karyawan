## Aplikasi Cuti Karyawan
Aplikasi cuti karyawan ini dibangun dengan menggunakan php native dengan database yang digunakan adalah mysql

## Penambahan changeset
Pastikan untuk menambahkan liquibase format sql pada awal changeset sebelum menuliskan script sql yang akan di running

```
--liquibase formatted sql

--changeset {author}:{number_id} labels:{labels_changeset} context:{context_changeset} splitStatements:true endDelimiter:;

--comment: {note}

CREATE TABLE ......

--rollback ... --> pastikan untuk menambahkan perintah rollback, agar ketika ada rollback yang mengeksekusi tetap liquibase tidak dijalankan secara manual
```

Berikut adalah contoh sederhana pembuatan changeset liquibase format sql

```
--liquibase formatted sql

--changeset automated_by_jenkins:0001 labels:db-dev context:create_table_employee splitStatements:true endDelimiter:;

--comment: db-dev


CREATE TABLE employee (id INT, first_name VARCHAR, PRIMARY KEY (id))

-- rollback DROP TABLE employee;
```

## Penambahan Changelog

Secara default master-changelog akan disediakan oleh tim DBA. Nantinya ketika ada penambahan changeset, master-changelog juga akan ada perubahan mengikuti format line atasnya.

Berikut adalah contoh master-changelog.xml

```
<?xml version="1.0" encoding="UTF-8"?>

<databaseChangeLog xmlns="http://www.liquibase.org/xml/ns/dbchangelog" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:pro="http://www.liquibase.org/xml/ns/pro" xsi:schemaLocation="http://www.liquibase.org/xml/ns/dbchangelog http://www.liquibase.org/xml/ns/dbchangelog/dbchangelog-4.6.xsd
    http://www.liquibase.org/xml/ns/pro http://www.liquibase.org/xml/ns/pro/liquibase-pro-4.6.xsd ">

 <include file="./changeset/0001-add-sequences-table.sql" relativeToChangelogFile="true" /> 
 <include file="./changeset/0002-add-table_jobs_password.sql" relativeToChangelogFile="true" /> 
 <include file="./changeset/0003-add-table-migration.sql" relativeToChangelogFile="true" />  
 <include file="./changeset/0004-add-table-ms.sql" relativeToChangelogFile="true" />  
 <include file="./changeset/0005-add-table-ms-2.sql" relativeToChangelogFile="true" />  
  <!-- more <include> tags go here -->
</databaseChangeLog>
```

Contoh ketika ada penambahan changeset terbaru `0100-add-table-ms_agreement_confins.sql`, maka tambahkan perintah `include file` pada master-changelog seperti contoh berikut.

```
<?xml version="1.0" encoding="UTF-8"?>

<databaseChangeLog xmlns="http://www.liquibase.org/xml/ns/dbchangelog" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:pro="http://www.liquibase.org/xml/ns/pro" xsi:schemaLocation="http://www.liquibase.org/xml/ns/dbchangelog http://www.liquibase.org/xml/ns/dbchangelog/dbchangelog-4.6.xsd
    http://www.liquibase.org/xml/ns/pro http://www.liquibase.org/xml/ns/pro/liquibase-pro-4.6.xsd ">

 <include file="./changeset/0001-add-sequences-table.sql" relativeToChangelogFile="true" /> 
 <include file="./changeset/0002-add-table_jobs_password.sql" relativeToChangelogFile="true" /> 
 <include file="./changeset/0003-add-table-migration.sql" relativeToChangelogFile="true" />  
 <include file="./changeset/0004-add-table-ms.sql" relativeToChangelogFile="true" />  
 <include file="./changeset/0005-add-table-ms-2.sql" relativeToChangelogFile="true" />  
 <include file="./changeset/0100-add-table-ms_agreement_confins.sql" relativeToChangelogFile="true" /> 
  <!-- more <include> tags go here -->
</databaseChangeLog>
```
