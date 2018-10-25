-- we don't know how to generate schema Connect (class Schema) :(
create table if not exists attendance_log
(
	idx bigint auto_increment,
	staff_id bigint not null,
	tmn_hw_id bigint not null,
	tmn_time timestamp not null,
	type varchar(100) null,
	admin_id bigint null,
	created_dt timestamp default CURRENT_TIMESTAMP not null,
	constraint attendance_log_idx_uindex
		unique (idx)
)
;

alter table attendance_log
	add primary key (idx)
;

create table if not exists auth
(
	id int auto_increment,
	username varchar(100) not null,
	password varchar(200) null,
	fullname varchar(200) not null,
	status int default '0' null,
	created_dt timestamp default CURRENT_TIMESTAMP null,
	created_by varchar(200) null,
	profilepic varchar(200) null,
	constraint credentials_auth_id_uindex
		unique (id)
)
;

alter table auth
	add primary key (id)
;

create table if not exists category
(
	cat_id bigint auto_increment,
	category_name varchar(100) not null,
	node varchar(100) null,
	node_root int default '1' null,
	parent_id bigint null,
	created_dt timestamp default CURRENT_TIMESTAMP null,
	created_by varchar(200) not null,
	updated_dt timestamp null,
	updated_by varchar(100) null,
	status int default '1' not null,
	constraint category_cat_id_uindex
		unique (cat_id)
)
;

alter table category
	add primary key (cat_id)
;

create table if not exists customer
(
	customer_id bigint auto_increment,
	customer_name varchar(200) null,
	phone varchar(20) null,
	address text null,
	status int default '1' not null,
	created_dt timestamp default CURRENT_TIMESTAMP null,
	created_by varchar(200) null,
	updated_dt timestamp null,
	updated_by varchar(200) null,
	card_no varchar(20) null,
	constraint customer_customer_id_uindex
		unique (customer_id)
)
charset=utf8mb4
;

alter table customer
	add primary key (customer_id)
;

create table if not exists fingerprint
(
	fingerprint_id bigint auto_increment,
	staff_id bigint not null,
	template text not null,
	image text null,
	type int null,
	pin varchar(32) null,
	pin_date timestamp null,
	created_dt timestamp default CURRENT_TIMESTAMP not null,
	created_by varchar(200) not null,
	updated_dt timestamp null,
	updated_by varchar(200) null,
	short_name varchar(100) null,
	constraint fingerprint_fingerprint_id_uindex
		unique (fingerprint_id)
)
;

alter table fingerprint
	add primary key (fingerprint_id)
;

create table if not exists node
(
	cat_id bigint auto_increment,
	category_name varchar(200) null,
	parent_id bigint not null,
	node varchar(100) null,
	created_dt timestamp default CURRENT_TIMESTAMP null,
	created_by varchar(200) not null,
	updated_dt timestamp null,
	updated_by varchar(200) null,
	status int default '1' null,
	node_root int null,
	constraint category_cat_id_uindex
		unique (cat_id)
)
;

alter table node
	add primary key (cat_id)
;

create table if not exists payment_mode
(
	mode_id bigint auto_increment,
	mode_code varchar(100) null,
	mode_name varchar(100) null,
	status int default '1' not null,
	created_dt timestamp default CURRENT_TIMESTAMP null,
	created_by varchar(200) not null,
	updated_dt timestamp null,
	updated_by varchar(200) null,
	constraint payment_mode_mode_id_uindex
		unique (mode_id)
)
;

alter table payment_mode
	add primary key (mode_id)
;

create table if not exists re
(
	idx bigint auto_increment,
	stock_id bigint not null,
	tmn_hw_id bigint not null,
	tmn_txn_id bigint not null,
	operation int default '1' not null,
	quantity decimal default '0' not null,
	balance decimal default '0' not null,
	staff_id bigint not null,
	staff_card varchar(30) null,
	tmn_time datetime null,
	created_dt timestamp default CURRENT_TIMESTAMP not null,
	created_by varchar(200) null,
	stock_name varchar(200) null,
	stock_code varchar(200) null,
	remarks varchar(256) null,
	constraint stock_movement_idx_uindex
		unique (idx)
)
;

alter table re
	add primary key (idx)
;

create table if not exists sales
(
	idx bigint auto_increment,
	tmn_hw_id bigint not null,
	tmn_txn_id bigint not null,
	tax decimal default '0' null,
	discount decimal default '0' not null,
	staff_card varchar(100) null,
	created_by varchar(200) not null,
	created_dt timestamp default CURRENT_TIMESTAMP not null,
	staff_id bigint null,
	remarks varchar(256) null,
	tmn_time datetime not null,
	customer_id bigint null,
	customer_name varchar(200) null,
	constraint sales_idx_uindex
		unique (idx)
)
;

alter table sales
	add primary key (idx)
;

create table if not exists sales_detail
(
	line_id bigint auto_increment,
	tmn_hw_id bigint not null,
	tmn_txn_id bigint not null,
	stock_id bigint not null,
	quantity decimal default '0' not null,
	line_tax decimal default '0' not null,
	line_discount decimal default '0' not null,
	line_total decimal default '0' not null,
	remarks varchar(256) null,
	staff_id bigint not null,
	staff_card varchar(30) null,
	tmn_time datetime null,
	created_by varchar(200) not null,
	created_dt timestamp default CURRENT_TIMESTAMP not null,
	sales_id bigint not null,
	stock_name varchar(200) null,
	stock_code varchar(200) null,
	unit_price decimal default '0' not null,
	customer_id bigint null,
	customer_name varchar(200) null,
	constraint sales_detail_line_id_uindex
		unique (line_id)
)
;

alter table sales_detail
	add primary key (line_id)
;

create table if not exists session
(
	id bigint auto_increment,
	authId bigint null,
	token varchar(1000) null,
	date timestamp null,
	constraint sessions_id_uindex
		unique (id)
)
;

alter table session
	add primary key (id)
;

create table if not exists staff
(
	staff_id bigint auto_increment,
	staff_code varchar(100) not null,
	staff_name varchar(200) not null,
	card_no varchar(20) not null,
	phone varchar(20) null,
	department varchar(100) null,
	status int default '1' not null,
	created_dt timestamp default CURRENT_TIMESTAMP null,
	created_by varchar(100) not null,
	updated_dt timestamp null,
	updated_by varchar(100) null,
	role int default '0' not null,
	constraint staff_staff_id_uindex
		unique (staff_id)
)
;

alter table staff
	add primary key (staff_id)
;

create table if not exists stock
(
	stock_id bigint auto_increment,
	stock_code varchar(200) not null,
	stock_name varchar(200) not null,
	status int default '1' null,
	created_dt timestamp default CURRENT_TIMESTAMP not null,
	updated_dt timestamp null,
	min_price decimal null,
	max_price decimal null,
	tax_group int default '1' null,
	cat_id bigint default '-1' null,
	created_by varchar(200) null,
	updated_by varchar(100) null,
	stock_enabled tinyint(1) default '1' null,
	constraint stock_stock_id_uindex
		unique (stock_id)
)
charset=utf8mb4
;

alter table stock
	add primary key (stock_id)
;

create table if not exists stock_movement
(
	idx bigint auto_increment,
	stock_id bigint not null,
	stock_code varchar(200) null,
	stock_name varchar(200) null,
	tmn_hw_id bigint not null,
	tmn_txn_id bigint not null,
	operation int default '1' not null,
	quantity decimal default '0' not null,
	balance decimal default '0' not null,
	staff_id bigint not null,
	staff_card varchar(30) not null,
	tmn_time datetime null,
	created_dt timestamp default CURRENT_TIMESTAMP null,
	created_by varchar(200) not null,
	remarks varchar(256) null,
	constraint stock_movement_idx_uindex
		unique (idx)
)
;

alter table stock_movement
	add primary key (idx)
;

create table if not exists store
(
	store_id bigint auto_increment,
	store_code varchar(200) not null,
	store_name varchar(200) not null,
	parent_id bigint null,
	status int default '1' not null,
	created_dt timestamp default CURRENT_TIMESTAMP null,
	created_by varchar(200) not null,
	updated_dt timestamp null,
	updated_by varchar(200) null,
	node varchar(200) null,
	node_root int null,
	constraint store_store_id_uindex
		unique (store_id)
)
charset=utf8mb4
;

alter table store
	add primary key (store_id)
;

create table if not exists supplier
(
	supplier_id bigint auto_increment,
	supplier_name varchar(200) not null,
	supplier_code varchar(200) not null,
	address varchar(1000) null,
	phone varchar(20) null,
	status int default '1' null,
	created_dt timestamp default CURRENT_TIMESTAMP null,
	created_by varchar(200) null,
	updated_dt timestamp null,
	updated_by varchar(200) null,
	constraint supplier_supplier_id_uindex
		unique (supplier_id)
)
;

alter table supplier
	add primary key (supplier_id)
;

create function fn_adjustNode (node varchar(200), bottom int) returns varchar(200)
BEGIN
    DECLARE output VARCHAR(4096) DEFAULT '';
    DECLARE occurences INT DEFAULT 0;
    DECLARE i INT DEFAULT 1;

    SET occurences = fn_count_occurences(node, '.');
    IF (occurences > 0)
    THEN
       SET output = bottom + fn_strSplit(node, '.', i);
      -- cater for multi-tier nodes
      -- SET i = i+1;
      WHILE i <= occurences
      DO
        SET i = i+1;
       SET output = CONCAT(output, '.', fn_strSplit(node, '.', i));
      END WHILE;
    ELSE
      SET output = (bottom + node);
    END IF;
    RETURN output;
  END
;

create function fn_buildCustomerFiles () returns text
BEGIN

    DECLARE output TEXT;

    SET @file_type = 7;
    SET @file_name = 'CUSTOMER.TXT';
    SET @file_id = 1;


    SELECT CONCAT(GROUP_CONCAT(customers SEPARATOR '
'), CHAR(10)) INTO output
    FROM (
        SELECT CONCAT(card_no, '|', customer_id, '|', customer_name, '|', card_no, '|', phone, '|', address, '|') as customers
    FROM customer WHERE status = 1 AND COALESCE(card_no, '') != '' AND COALESCE(customer_name,'') != ''
             ) AS DATA;


    SET output = CONCAT(
        'T=', hex(@file_type), CHAR(10)
        , 'I=', hex(@file_id), CHAR(10)
        , 'R=1', CHAR(10)
        , 'L=', @file_name, CHAR(10)
        , 'M=1', CHAR(10)
        , 'D=', CHAR(10), COALESCE(output, '')
    );
    SET output = CONCAT('B=', LENGTH(output), CHAR(10), output);

    RETURN output;

  END
;

create function fn_buildFingerprintFile () returns text
BEGIN
    DECLARE output TEXT;
    DECLARE fpdata TEXT;
    DECLARE staffdata TEXT;
    DECLARE breakdata TEXT;
    DECLARE fdata TEXT;
    DECLARE sdata TEXT;
    DECLARE bdata TEXT;
    SET @file_type = 6;
    SET @fp_file_name = 'FINGERDB.TXT';
    SET @staff_file_name = 'STAFFDAT.TXT';
    SET @breakMaxMenuTime_file_name = 'TERMSETT.CFG';
    SET @file_id = 3;

    SET @menu_timeout_time = 1800;

    SET bdata = CONCAT('PowerUpSkipPrint|1', CHAR(10), 'BrkMaxMenuTime|', @menu_timeout_time, CHAR(10));


    SELECT CONCAT(GROUP_CONCAT(fp_stuff SEPARATOR '
'), CHAR(10))
        INTO fdata
    FROM (SELECT CONCAT(a.staff_code, '|', b.fingerprint_id, '|', COALESCE(b.pin, ''), '|',
                        COALESCE(b.pin_date, '2000-01-01 00:00:00'), '|', a.staff_name, '|', b.created_dt, '|',
                        b.template) as fp_stuff

          FROM staff AS a
                 INNER JOIN fingerprint AS b ON a.staff_id = b.staff_id AND COALESCE(b.template, '') != '') AS data;


    SELECT CONCAT(GROUP_CONCAT(staff_stuff SEPARATOR '
'), CHAR(10)) INTO sdata
    FROM (SELECT CONCAT(a.staff_code, '|', a.staff_id, '|', b.pin, '|', COALESCE(b.pin_date, '2000-01-01 00:00:00'),
                        '|', a.role, '|', a.staff_name, '|', LEFT(a.staff_name, 10)) as staff_stuff
          FROM staff AS a
                 INNER JOIN fingerprint AS b ON a.staff_id = b.staff_id AND COALESCE(b.template, '') != ''

          UNION ALL
          SELECT CONCAT(a.staff_code, '|', a.staff_id, '||', '2000-01-01 00:00:00',
                        '|', a.role, '|', a.staff_name, '|', LEFT(a.staff_name, 10)) as staff_stuff
          FROM staff a
                 LEFT OUTER JOIN fingerprint b ON a.staff_id = b.staff_id
          WHERE COALESCE(b.staff_id, 0) = 0) AS data;

    SET fpdata = CONCAT(
        'T=', hex(@file_type), CHAR(10)
        , 'I=', hex(@file_id), CHAR(10)
        , 'R=1', CHAR(10)
        , 'L=', @fp_file_name, CHAR(10)
        , 'M=1', CHAR(10)
        , 'FDATE=', current_timestamp, CHAR(10)
        , 'D=', CHAR(10), COALESCE(LTRIM(RTRIM(fdata)), '')
    );
    SET fpdata = CONCAT('B=', LENGTH(fpdata), CHAR(10), fpdata);

    SET staffdata = CONCAT(
        'T=', hex(@file_type), CHAR(10)
        , 'I=', hex(@file_id), CHAR(10)
        , 'R=1', CHAR(10)
        , 'L=', @staff_file_name, CHAR(10)
        , 'M=1', CHAR(10)
        , 'D=', CHAR(10), COALESCE(LTRIM(RTRIM(sdata)), '')
    );
    SET staffdata = CONCAT('B=', LENGTH(staffdata), CHAR(10), staffdata);


    SET breakdata = CONCAT(
        'T=', hex(@file_type), CHAR(10)
        , 'I=', hex(-2), CHAR(10)
        , 'R=1', CHAR(10)
        , 'L=', @breakMaxMenuTime_file_name, CHAR(10)
        , 'M=1', CHAR(10)
        , 'D=', CHAR(10), COALESCE(bdata, '')
    );
    SET breakdata = CONCAT('B=', LENGTH(breakdata), CHAR(10), breakdata);

    SET output = CONCAT(fpdata, staffdata, breakdata);

    /* IF COALESCE(sdata, fdata, '') = ''
     THEN
       SET output = '';
     END IF;*/


    RETURN output;

  END
;

create function fn_buildStockFile () returns text
BEGIN
    DECLARE output TEXT;

    SET @file_type = 6;
    SET @file_name = 'CAT.TXT';
    SET @file_id = 1;
    SET @bottom_node = 0;

    SET @otherheaders = '';

    SELECT COUNT(1) INTO @bottom_node FROM stock WHERE status = 1
                                                   AND COALESCE(cat_id,-1) = -1;
    DROP TEMPORARY TABLE IF EXISTS content;
    CREATE TEMPORARY TABLE content (
      nodevalue VARCHAR(100),
      nodes     VARCHAR(100),
      line      VARCHAR(1000)
    );

    INSERT INTO content (nodevalue, nodes, line)
    VALUES ('000001', '01', CONCAT('T=', hex(@file_type))),
           ('000001', '02', CONCAT('I=', hex(@file_id))),
           ('000001', '03', 'R=1'),
           ('000001', '04', CONCAT('L=', @file_name)),
           ('000001', '05', 'M=1'),
           ('000001', '06', @otherHeaders),
           ('000001', '07', 'D=');

    INSERT INTO content (nodevalue, nodes, line)
    SELECT fn_nodeValue(nodes, '00000', 5), nodes, CONCAT(
                                                     coalesce(nodes, ''), '|', stock_id, '|', stock_id, '||',
                                                     fn_urlEncode(description), '|', coalesce(min_price, 0), '|',
                                                     coalesce(max_price, min_price, 0), '|', tax_group, '|', stock_code,
                                                     '|', coalesce(max_price, min_price, 0), '|11' -- out tax code
                                                     , '|', tax_group, '|2') as line
    FROM (SELECT CONCAT(
                   ROW_NUMBER() OVER(PARTITION BY (SELECT 1) ORDER BY x.stock_name, x.stock_id)) as nodes,
                 x.stock_code,
                 x.stock_id,
                 x.stock_name                                                                    as description,
                 x.min_price,
                 x.max_price,
                 x.tax_group
          FROM stock x WHERE status = 1 AND cat_id = -1

          UNION ALL

          SELECT fn_adjustNode(node, @bottom_node) as nodes,
                 LEFT(category_name, 5)            as stock_code,
                 0                                 as stock_id,
                 LEFT(category_name, 20)           as description,
                 0                                 as min_price,
                 0                                 as max_price,
                 0                                 as tax_group
          FROM category
          WHERE status = 1

          UNION ALL

          SELECT COALESCE(fn_adjustNode(a.nodes, @bottom_node), 'x'),
                 a.stock_code,
                 a.stock_id,
                 a.stock_name,
                 a.min_price,
                 a.max_price,
                 a.tax_group
          FROM (SELECT x.stock_code,
                       x.stock_id,
                       x.stock_name,
                       x.min_price,
                       x.max_price,
                       x.tax_group,
                       CONCAT(c.node, '.',
                              ROW_NUMBER() OVER(PARTITION BY x.cat_id ORDER BY x.stock_name, x.stock_id)) as nodes
                FROM stock AS x
                       INNER JOIN category AS c ON c.status = 1 AND x.status = 1 AND c.cat_id = x.cat_id) AS a)
             AS _data;

    SELECT CONCAT(GROUP_CONCAT(line SEPARATOR '
'), CHAR(10)) INTO output
    FROM content WHERE LENGTH(line) > 0
    ORDER BY (LENGTH(nodes) - LENGTH(replace(nodes, '.', ''))), nodevalue;

    SET output = CONCAT('B=', LENGTH(output), CHAR(10), output);

    DROP TEMPORARY TABLE content;
    RETURN output;
  END
;

create function fn_buildStoreFile () returns text
BEGIN
    DECLARE output TEXT;


    DECLARE file_data TEXT DEFAULT '';

    SET @file_type = 6;
    SET @file_name = 'STORE.LST';
    SET @file_id = 1;

    SET @otherheaders = CONCAT('SCAN=1', CHAR(10),
                               'O_EN=Please select one ', CHAR(10),
                               'SEARCH_COL=2;6,1,LOCMAP.TXT;1,3', CHAR(10));


    SET file_data = CONCAT('-1|N/A|0|', CHAR(10));

    SELECT CONCAT(file_data, GROUP_CONCAT(rex SEPARATOR '
'), CHAR(10)) INTO file_data
    FROM (SELECT concat(store_code, '|', store_id, '|', store_name, '|0|') as rex
          FROM store
          WHERE status = 1
          ORDER BY store_name ASC) X;

    SET @fd_data = CONCAT(
        'T=', hex(@file_type), CHAR(10),
        'I=', hex(@file_id), CHAR(10),
        'R=1', CHAR(10),
        'L=', @file_name, CHAR(10),
        'M=1', CHAR(10),
        @otherheaders,
        'D=', CHAR(10),
        COALESCE(file_data, ''));

    SET @datalength = LENGTH(@fd_data);

    SET output = CONCAT('B=', @datalength, CHAR(10), @fd_data);


    RETURN output;
  END
;

create function fn_buildSupplierFiles () returns text
BEGIN

    DECLARE output TEXT;

    SET @file_type = 7;
    SET @file_name = 'SUPPLIER.TXT'; -- DOS 8.3
    SET @file_id = 1;


    SELECT CONCAT(GROUP_CONCAT(suppliers SEPARATOR '
'), CHAR(10)) INTO output
    FROM (
        SELECT CONCAT(supplier_code, '|', supplier_id, '|', supplier_name, '|', supplier_code, '|', phone, '|', address, '|') as suppliers
    FROM supplier WHERE status = 1 AND COALESCE(supplier_code, '') != '' AND COALESCE(supplier_name,'') != ''
             ) AS DATA;


    SET output = CONCAT(
        'T=', hex(@file_type), CHAR(10)
        , 'I=', hex(@file_id), CHAR(10)
        , 'R=1', CHAR(10)
        , 'L=', @file_name, CHAR(10)
        , 'M=1', CHAR(10)
        , 'D=', CHAR(10), COALESCE(output, '')
    );
    SET output = CONCAT('B=', LENGTH(output), CHAR(10), output);

    RETURN output;

  END
;

create function fn_buildSupportingFiles () returns text
BEGIN
    DECLARE output TEXT;

    -- UOM LIST
    SET @otherHeaders = CONCAT('O_EN=Please select UOM', CHAR(10),
                               'O_BM=Sila pilih UOM', CHAR(10),
                               'O_DEF=1|Units|0|', CHAR(10));

    SET @file_data = CONCAT('1|Units|0|', CHAR(10));

    SET @file_type = 6;
    SET @file_name = 'OPT1.TXT';
    SET @file_id = 1;

    SET @fd_data = CONCAT(
        'T=', hex(@file_type), CHAR(10),
        'I=', hex(@file_id), CHAR(10),
        'R=1', CHAR(10),
        'L=', @file_name, CHAR(10),
        'M=1', CHAR(10),
        @otherheaders,
        'D=', CHAR(10),
        COALESCE(@file_data, ''));


    SET output = CONCAT('B=', LENGTH(@fd_data), CHAR(10), @fd_data);

    -- TAX TYPES
    SET @otherHeaders = CONCAT('O_EN=Please select Tax', CHAR(10),
                               'O_BM=Sila pilih TAX', CHAR(10),
                               'O_DEF=5|No Tax|0|', CHAR(10));

    SET @file_data = CONCAT('5|No Tax|0|', CHAR(10));

    SET @file_type = 6;
    SET @file_name = 'OPT2.TXT';
    SET @file_id = 1;

    SET @fd_data = CONCAT(
        'T=', hex(@file_type), CHAR(10),
        'I=', hex(@file_id), CHAR(10),
        'R=1', CHAR(10),
        'L=', @file_name, CHAR(10),
        'M=1', CHAR(10),
        @otherheaders,
        'D=', CHAR(10),
        COALESCE(@file_data, ''));

    SET output = CONCAT(output, 'B=', LENGTH(@fd_data), CHAR(10), @fd_data);

    -- TAX TYPES -
    SET @otherHeaders = CONCAT('O_EN=Please select Tax', CHAR(10),
                               'O_BM=Sila pilih TAX', CHAR(10),
                               'O_DEF=5|No Tax 0 %25|0|', CHAR(10));

    SET @file_data = CONCAT('5|No Tax 0 %25|0|', CHAR(10));

    SET @file_type = 6;
    SET @file_name = 'OPT4.TXT';
    SET @file_id = 1;

    SET @fd_data = CONCAT(
        'T=', hex(@file_type), CHAR(10),
        'I=', hex(@file_id), CHAR(10),
        'R=1', CHAR(10),
        'L=', @file_name, CHAR(10),
        'M=1', CHAR(10),
        @otherheaders,
        'D=', CHAR(10),
        COALESCE(@file_data, ''));

    SET output = CONCAT(output, 'B=', LENGTH(@fd_data), CHAR(10), @fd_data);

    -- TAX TYPES -
    SET @otherHeaders = CONCAT('O_EN=Please select Tax', CHAR(10),
                               'O_BM=Sila pilih TAX', CHAR(10),
                               'O_DEF=3|N/A|0|', CHAR(10));

    SET @file_data = CONCAT('3|N/A|0|', CHAR(10));

    SET @file_type = 6;
    SET @file_name = 'OPT6.TXT';
    SET @file_id = 1;

    SET @fd_data = CONCAT(
        'T=', hex(@file_type), CHAR(10),
        'I=', hex(@file_id), CHAR(10),
        'R=1', CHAR(10),
        'L=', @file_name, CHAR(10),
        'M=1', CHAR(10),
        @otherheaders,
        'D=', CHAR(10),
        COALESCE(@file_data, ''));

    SET output = CONCAT(output, 'B=', LENGTH(@fd_data), CHAR(10), @fd_data);

    -- TAX TYPES -
    SET @otherHeaders = CONCAT('O_EN=Please select Tax', CHAR(10),
                               'O_BM=Sila pilih TAX', CHAR(10),
                               'O_DEF=1|NO VAT 0%25|0|26|26|26|', CHAR(10));

    SET @file_data = CONCAT('1|NO VAT 0%25|0|26|26|26|', CHAR(10));

    SET @file_type = 6;
    SET @file_name = 'OPT5.TXT';
    SET @file_id = 1;

    SET @fd_data = CONCAT(
        'T=', hex(@file_type), CHAR(10),
        'I=', hex(@file_id), CHAR(10),
        'R=1', CHAR(10),
        'L=', @file_name, CHAR(10),
        'M=1', CHAR(10),
        @otherheaders,
        'D=', CHAR(10),
        COALESCE(@file_data, ''));

    SET output = CONCAT(output, 'B=', LENGTH(@fd_data), CHAR(10), @fd_data);


     -- TAX TYPES -
    SET @otherHeaders = CONCAT('O_EN=Please select Tax', CHAR(10),
                               'O_BM=Sila pilih TAX', CHAR(10),
                               'O_DEF=3|NO VAT|0|', CHAR(10));

    SET @file_data = CONCAT('3|NO VAT|0|', CHAR(10));

    SET @file_type = 6;
    SET @file_name = 'OPT8.TXT';
    SET @file_id = 1;

    SET @fd_data = CONCAT(
        'T=', hex(@file_type), CHAR(10),
        'I=', hex(@file_id), CHAR(10),
        'R=1', CHAR(10),
        'L=', @file_name, CHAR(10),
        'M=1', CHAR(10),
        @otherheaders,
        'D=', CHAR(10),
        COALESCE(@file_data, ''));

    SET output = CONCAT(output, 'B=', LENGTH(@fd_data), CHAR(10), @fd_data);

     -- TAX TYPES -
    SET @otherHeaders = CONCAT('O_EN=Please select Tax', CHAR(10),
                               'O_BM=Sila pilih TAX', CHAR(10),
                               'O_DEF=VAT|3|', CHAR(10));

    SET @file_data = CONCAT('NO VAT|1|', CHAR(10), 'VAT|3|',CHAR(10));

    SET @file_type = 6;
    SET @file_name = 'GST.TXT';
    SET @file_id = 100;

    SET @fd_data = CONCAT(
        'T=', hex(@file_type), CHAR(10),
        'I=', hex(@file_id), CHAR(10),
        'R=1', CHAR(10),
        'L=', @file_name, CHAR(10),
        'M=1', CHAR(10),
        @otherheaders,
        'D=', CHAR(10),
        COALESCE(@file_data, ''));

    SET output = CONCAT(output, 'B=', LENGTH(@fd_data), CHAR(10), @fd_data);


    -- RECEIVE TAX TYPES
    SET @otherHeaders = CONCAT('O_EN=Please select Tax', CHAR(10),
                               'O_BM=Sila pilih TAX', CHAR(10),
                               'O_DEF=1|Yes|0|', CHAR(10));

    SET @file_data = CONCAT('1|Yes|0|', CHAR(10), '2|No|0|', CHAR(10),
                            '3|IM|0|', CHAR(10));

    SET @file_type = 6;
    SET @file_name = 'OPT3.TXT';
    SET @file_id = 1;

    SET @fd_data = CONCAT(
        'T=', hex(@file_type), CHAR(10),
        'I=', hex(@file_id), CHAR(10),
        'R=1', CHAR(10),
        'L=', @file_name, CHAR(10),
        'M=1', CHAR(10),
        @otherheaders,
        'D=', CHAR(10),
        COALESCE(@file_data, ''));


    SET output = CONCAT(output, 'B=', LENGTH(@fd_data), CHAR(10), @fd_data);

    -- PAYMENT MODES
    SET @otherHeaders = CONCAT('O_EN=Select Payment Mode', CHAR(10),
                               'O_BM=Sila pilih PM', CHAR(10),
                               'O_DEF=-1|Cash|Cash|0|', CHAR(10));

    SELECT CONCAT(GROUP_CONCAT(line SEPARATOR '
'),CHAR(10)) INTO @file_data
    FROM (SELECT CONCAT(mode_id, '|', mode_name, '|', mode_code, '|0|') as line
          FROM payment_mode
          WHERE status = 1) AS DATA;

    SET @file_type = 6;
    SET @file_name = 'OPT9.TXT';
    SET @file_id = 1;

    SET @fd_data = CONCAT(
        'T=', hex(@file_type), CHAR(10),
        'I=', hex(@file_id), CHAR(10),
        'R=1', CHAR(10),
        'L=', @file_name, CHAR(10),
        'M=1', CHAR(10),
        @otherheaders,
        'D=', CHAR(10),
        COALESCE(@file_data, ''));


    SET output = CONCAT(output, 'B=', LENGTH(@fd_data), CHAR(10), @fd_data);
    -- duplicate file for OPTPAY
    SET @file_type = 6;
    SET @file_name = 'OPTPAY.TXT';
    SET @file_id = 1;

    SET @fd_data = CONCAT(
        'T=', hex(@file_type), CHAR(10),
        'I=', hex(@file_id), CHAR(10),
        'R=1', CHAR(10),
        'L=', @file_name, CHAR(10),
        'M=1', CHAR(10),
        @otherheaders,
        'D=', CHAR(10),
        COALESCE(@file_data, ''));

    SET @datalength = LENGTH(@fd_data);

    SET output = CONCAT(output, 'B=', LENGTH(@fd_data), CHAR(10), @fd_data);

    -- STOCK TAKE OPTIONS -- OVR
    SET @otherHeaders = CONCAT('O_EN=Please select', CHAR(10),
                               'O_BM=Sila pilih', CHAR(10),
                               'O_DEF=-1|Overwrite', CHAR(10));

    SET @file_data = CONCAT('-1|Overwrite', CHAR(10), '-2|Add|ADD', CHAR(10),
                            '-3|Reduce|SUB', CHAR(10));

    SET @file_type = 6;
    SET @file_name = 'OPT8_OVR.TXT';
    SET @file_id = 1;

    SET @fd_data = CONCAT(
        'T=', hex(@file_type), CHAR(10),
        'I=', hex(@file_id), CHAR(10),
        'R=1', CHAR(10),
        'L=', @file_name, CHAR(10),
        'M=1', CHAR(10),
        @otherheaders,
        'D=', CHAR(10),
        COALESCE(@file_data, ''));


    SET output = CONCAT(output, 'B=', LENGTH(@fd_data), CHAR(10), @fd_data);

    -- STOCK TAKE OPTIONS -- ADD
    SET @otherHeaders = CONCAT('O_EN=Please select', CHAR(10),
                               'O_BM=Sila pilih', CHAR(10),
                               'O_DEF=-2|ADD', CHAR(10));

    SET @file_data = CONCAT('-1|Overwrite', CHAR(10), '-2|Add|ADD', CHAR(10),
                            '-3|Reduce|SUB', CHAR(10));

    SET @file_type = 6;
    SET @file_name = 'OPT8_ADD.TXT';
    SET @file_id = 1;

    SET @fd_data = CONCAT(
        'T=', hex(@file_type), CHAR(10),
        'I=', hex(@file_id), CHAR(10),
        'R=1', CHAR(10),
        'L=', @file_name, CHAR(10),
        'M=1', CHAR(10),
        @otherheaders,
        'D=', CHAR(10),
        COALESCE(@file_data, ''));


    SET output = CONCAT(output, 'B=', LENGTH(@fd_data), CHAR(10), @fd_data);

    -- STOCK TAKE OPTIONS -- SUB
    SET @otherHeaders = CONCAT('O_EN=Please select', CHAR(10),
                               'O_BM=Sila pilih', CHAR(10),
                               'O_DEF=-3|Reduce', CHAR(10));

    SET @file_data = CONCAT('-1|Overwrite', CHAR(10), '-2|Add|ADD', CHAR(10),
                            '-3|Reduce|SUB', CHAR(10));

    SET @file_type = 6;
    SET @file_name = 'OPT8_SUB.TXT';
    SET @file_id = 1;

    SET @fd_data = CONCAT(
        'T=', hex(@file_type), CHAR(10),
        'I=', hex(@file_id), CHAR(10),
        'R=1', CHAR(10),
        'L=', @file_name, CHAR(10),
        'M=1', CHAR(10),
        @otherheaders,
        'D=', CHAR(10),
        COALESCE(@file_data, ''));


    SET output = CONCAT(output, 'B=', LENGTH(@fd_data), CHAR(10), @fd_data);

    -- CATEGORIES
    SET @otherHeaders = CONCAT('O_EN=Select Category', CHAR(10),
                               'O_BM=Sila pilih PM', CHAR(10),
                               'O_DEF=-1|UNCATEGORIZED|0|', CHAR(10));

    SELECT CONCAT('-1|UNCATEGORIZED|0|',CHAR(10), GROUP_CONCAT(line SEPARATOR '
'),CHAR(10)) INTO @file_data
    FROM (SELECT CONCAT(cat_id, '|', category_name, '|0|') as line
          FROM category
          WHERE status = 1) AS DATA;

    SET @file_type = 6;
    SET @file_name = 'OPT7.TXT';
    SET @file_id = 1;

    SET @fd_data = CONCAT(
        'T=', hex(@file_type), CHAR(10),
        'I=', hex(@file_id), CHAR(10),
        'R=1', CHAR(10),
        'L=', @file_name, CHAR(10),
        'M=1', CHAR(10),
        @otherheaders,
        'D=', CHAR(10),
        COALESCE(@file_data, ''));


    SET output = CONCAT(output, 'B=', LENGTH(@fd_data), CHAR(10), @fd_data);


    RETURN output;
  END
;

create function fn_count_occurences (haystack text, needle varchar(32)) returns int
BEGIN
    RETURN ROUND((CHAR_LENGTH(haystack) - CHAR_LENGTH(REPLACE(haystack, needle, ""))) / CHAR_LENGTH(needle));
  END
;

create function fn_formulate_outputstring (buzzer varchar(10), lcd_line1 varchar(300), lcd_line2 varchar(300), lcd_line3 varchar(300), lcd_line4 varchar(300), printer varchar(4096)) returns varchar(4000)
BEGIN
    DECLARE B VARCHAR(10);
    DECLARE ret VARCHAR(4096);
    SET ret = '';

    IF buzzer = '3'
    THEN
      SET buzzer = 'A';
      SET B = 'B`';
    ELSE IF buzzer = '1'
    THEN
      SET B = '';
      SET buzzer = 'A';

    ELSE
      SET buzzer = 'E';
      SET B = 'B`';
    END IF;

      SET ret = CONCAT(ret, '{', B, buzzer, '`}');
      SET lcd_line1 = RTRIM(lcd_line1);
      SET lcd_line2 = RTRIM(lcd_line2);
      SET lcd_line3 = RTRIM(lcd_line3);
      SET lcd_line4 = RTRIM(lcd_line4);
      IF LENGTH(lcd_line1) > 0 OR LENGTH(lcd_line2) > 0 OR LENGTH(lcd_line3) > 0 OR LENGTH(lcd_line4) > 0
      THEN
        SET ret = CONCAT(ret, '{L`');
        IF LENGTH(lcd_line1) > 0
        THEN
          SET ret = CONCAT(ret, '[1`', lcd_line1, '`]');
        END IF;

        IF LENGTH(lcd_line2) > 0
        THEN
          SET ret = CONCAT(ret, '[2`', lcd_line2, '`]');
        END IF;
        IF LENGTH(lcd_line3) > 0
        THEN
          SET ret = CONCAT(ret, '[3`', lcd_line3, '`]');
        END IF;
        IF LENGTH(lcd_line4) > 0
        THEN
          SET ret = CONCAT(ret, '[4`', lcd_line4, '`]');
        END IF;
        SET ret = CONCAT(ret, '`}');
      END IF;

      SET printer = LTRIM(RTRIM(printer));

      IF LENGTH(printer) > 10
      THEN
        SET ret = CONCAT(ret, '{P`', '[T`', printer, '`]`}');
      END IF;

    END IF;

    RETURN ret;


  END
;

create function fn_nodeValue (node varchar(200), padding varchar(10), depth int) returns varchar(200)
BEGIN
    DECLARE output VARCHAR(4096) DEFAULT '';
    DECLARE NextString VARCHAR(40);
    DECLARE Pos INT;
    DECLARE NextPos INT;
    DECLARE depthCount INT;

    SET node = CONCAT(padding, node);
    IF (LOCATE('.', node) = 0)
    THEN
      RETURN CONCAT(RIGHT(node, 5), '.', padding, '.', padding);
    END IF;

    SET node = REPLACE(node, '.', CONCAT('.', padding));

    SET depthCount = 1;
    SET output = '';
    SET Pos = LOCATE('.', node);
    WHILE (pos <> 0)
    DO
      SET depthCount = depthCount + 1;
      SET NextString = substring(node, 1, Pos - 1);
      SET node = substring(node, pos + 1, LENGTH(node));
      SET output = output + RIGHT(NextString, 5);
      SET pos = LOCATE('.', node);
      IF (pos <> 0)
      THEN
        SET output = CONCAT(output, '.');
      ELSE
        SET output = CONCAT(output, '.', RIGHT(node, 5));
      END IF;

    END WHILE;

    WHILE (depthCount < depth)
    DO
      SET depthCount = depthCount + 1;
      SET output = CONCAT(output, '.', padding);
    END WHILE;


    RETURN output;
  END
;

create function fn_strSplit (x varchar(65000), delim varchar(12), pos int) returns varchar(65000)
BEGIN
    DECLARE output VARCHAR(65000);
    SET output = REPLACE(SUBSTRING(SUBSTRING_INDEX(x, delim, pos)
    , LENGTH(SUBSTRING_INDEX(x, delim, pos - 1)) + 1)
    , delim
    , '');
    IF output = '' THEN SET output = null; END IF;
    RETURN output;
  END
;

create procedure fn_updateCategoryHierarchy ()
BEGIN

    DECLARE _cat_id INTEGER;
    DECLARE _parent_id INTEGER;
    DECLARE v_finished INTEGER DEFAULT 0;
    DECLARE _node VARCHAR(200);
    DECLARE _next_node_int INT DEFAULT 0;
    DECLARE _node_root INT;
    DECLARE _child_count INT DEFAULT 0;
    DECLARE _cursor CURSOR FOR
      SELECT cat_id, parent_id FROM category WHERE status = 1 ORDER BY parent_id ASC;

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET v_finished = 1;

    -- reset all store nodes::
    UPDATE category
        SET node = null,
            node_root = null;

    OPEN _cursor;

    _loop: LOOP
      FETCH _cursor
      INTO _cat_id, _parent_id;

      SET _child_count = 0;
      SET _next_node_int = 0;

      IF COALESCE(_parent_id, 0) = 0 OR _parent_id = _cat_id -- root store
      THEN
        SELECT node_root INTO _next_node_int FROM category WHERE status = 1 ORDER BY node_root DESC LIMIT 1;
        SET _next_node_int = COALESCE(_next_node_int, 0) + 1;
        UPDATE category
            SET node = _next_node_int,
                node_root = _next_node_int
        WHERE cat_id = _cat_id;

        ELSE -- store with parent

        SELECT node_root, node INTO _node_root, _node FROM category WHERE cat_id = _parent_id AND status = 1;
        SELECT count(1) INTO _child_count FROM category WHERE parent_id = _parent_id AND status = 1 AND parent_id NOT IN (_parent_id, _cat_id);

        SET _child_count = COALESCE(_child_count, 0);
        SET _node = CONCAT(_node, '.', _child_count + 1);

        UPDATE category
            SET node_root = _node_root,
                node = _node
          WHERE  cat_id = _cat_id;

      END IF;

      IF v_finished = 1
      THEN
        LEAVE _loop;
      END IF;


    END LOOP _loop;
    CLOSE _cursor;


  END
;

create procedure fn_updateStoreHierarchy ()
BEGIN

    DECLARE _store_id INTEGER;
    DECLARE _parent_id INTEGER;
    DECLARE v_finished INTEGER DEFAULT 0;
    DECLARE _node VARCHAR(200);
    DECLARE _next_node_int INT DEFAULT 0;
    DECLARE _node_root INT;
    DECLARE _child_count INT DEFAULT 0;
    DECLARE _cursor CURSOR FOR
      SELECT store_id, parent_id FROM store WHERE status = 1 ORDER BY parent_id ASC;

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET v_finished = 1;

    -- reset all store nodes::
    UPDATE store
        SET node = null,
            node_root = null;

    OPEN _cursor;

    _loop: LOOP
      FETCH _cursor
      INTO _store_id, _parent_id;

      SET _child_count = 0;
      SET _next_node_int = 0;

      IF COALESCE(_parent_id, 0) = 0 OR _parent_id = _store_id -- root store
      THEN
        SELECT node_root INTO _next_node_int FROM store WHERE status = 1 ORDER BY node_root DESC LIMIT 1;
        SET _next_node_int = COALESCE(_next_node_int, 0) + 1;
        UPDATE store
            SET node = _next_node_int,
                node_root = _next_node_int
        WHERE store_id = _store_id;

        ELSE -- store with parent

        SELECT node_root, node INTO _node_root, _node FROM store WHERE store_id = _parent_id AND status = 1;
        SELECT count(1) INTO _child_count FROM store WHERE parent_id = _parent_id AND status = 1 AND parent_id NOT IN (_parent_id, _store_id);

        SET _child_count = COALESCE(_child_count, 0);
        SET _node = CONCAT(_node, '.', _child_count + 1);

        UPDATE store
            SET node_root = _node_root,
                node = _node
          WHERE  store_id = _store_id;

      END IF;

      IF v_finished = 1
      THEN
        LEAVE _loop;
      END IF;


    END LOOP _loop;
    CLOSE _cursor;


  END
;

create function fn_urlEncode (str varchar(4096)) returns varchar(4096)
BEGIN
    -- the individual character we are converting in our loop
    -- NOTE: must be VARCHAR even though it won't vary in length
    -- CHAR(1), when used with SUBSTRING, made spaces '' instead of ' '
    DECLARE sub VARCHAR(1) CHARSET utf8;
    -- the ordinal value of the character (i.e. ñ becomes 50097)
    DECLARE val BIGINT DEFAULT 0;
    -- the substring index we use in our loop (one-based)
    DECLARE ind INT DEFAULT 1;
    -- the integer value of the individual octet of a character being encoded
    -- (which is potentially multi-byte and must be encoded one byte at a time)
    DECLARE oct INT DEFAULT 0;
    -- the encoded return string that we build up during execution
    DECLARE ret VARCHAR(4096) DEFAULT '';
    -- our loop index for looping through each octet while encoding
    DECLARE octind INT DEFAULT 0;

    IF ISNULL(str) THEN
      RETURN NULL;
    ELSE
      SET ret = '';
      -- loop through the input string one character at a time - regardless
      -- of how many bytes a character consists of
      WHILE ind <= CHAR_LENGTH(str) DO
        SET sub = MID(str, ind, 1);
        SET val = ORD(sub);
        -- these values are ones that should not be converted
        -- see http://tools.ietf.org/html/rfc3986
        IF NOT (val BETWEEN 48 AND 57 OR     -- 48-57  = 0-9
                val BETWEEN 65 AND 90 OR     -- 65-90  = A-Z
                val BETWEEN 97 AND 122 OR    -- 97-122 = a-z
                -- 45 = hyphen, 46 = period, 95 = underscore, 126 = tilde
                val IN (45, 46, 95, 126)) THEN
          -- This is not an &quot;unreserved&quot; char and must be encoded:
          -- loop through each octet of the potentially multi-octet character
          -- and convert each into its hexadecimal value
          -- we start with the high octect because that is the order that ORD
          -- returns them in - they need to be encoded with the most significant
          -- byte first
          SET octind = OCTET_LENGTH(sub);
          WHILE octind > 0 DO
            -- get the actual value of this octet by shifting it to the right
            -- so that it is at the lowest byte position - in other words, make
            -- the octet/byte we are working on the entire number (or in even
            -- other words, oct will no be between zero and 255 inclusive)
            SET oct = (val >> (8 * (octind - 1)));
            -- we append this to our return string with a percent sign, and then
            -- a left-zero-padded (to two characters) string of the hexadecimal
            -- value of this octet)
            SET ret = CONCAT(ret, '%', LPAD(HEX(oct), 2, 0));
            -- now we need to reset val to essentially zero out the octet that we
            -- just encoded so that our number decreases and we are only left with
            -- the lower octets as part of our integer
            SET val = (val & (POWER(256, (octind - 1)) - 1));
            SET octind = (octind - 1);
          END WHILE;
        ELSE
          -- this character was not one that needed to be encoded and can simply be
          -- added to our return string as-is
          SET ret = CONCAT(ret, sub);
        END IF;
        SET ind = (ind + 1);
      END WHILE;
    END IF;
    RETURN ret;
  END
;

create procedure sp_tms_api (IN `_tmn_hw_id` bigint, IN action_id bigint, IN `_data` json, OUT output text)
proc: BEGIN

    DECLARE fdata TEXT;
    DECLARE cardno VARCHAR(20);
    DECLARE version VARCHAR(20);
    DECLARE ip_address VARCHAR(30);
    DECLARE txndate DATETIME;
    DECLARE tmntxnid BIGINT;
    DECLARE p1 TEXT;
    DECLARE p2 TEXT;
    DECLARE p3 TEXT;
    DECLARE p4 TEXT;
    DECLARE p5 TEXT;
    DECLARE p6 TEXT;
    DECLARE rid BIGINT;
    DECLARE m1 TEXT;
    DECLARE m2 TEXT;
    DECLARE p16 TEXT;
    DECLARE p32 TEXT;
    DECLARE p33 TEXT;
    DECLARE p34 TEXT;
    DECLARE p35 TEXT;
    DECLARE p36 TEXT;
    DECLARE p37 TEXT;
    DECLARE p38 TEXT;
    DECLARE p39 TEXT;
    DECLARE p40 TEXT;
    DECLARE p41 TEXT;
    DECLARE p42 TEXT;
    DECLARE p43 TEXT;
    DECLARE p44 TEXT;
    DECLARE p45 TEXT;
    DECLARE p46 TEXT;
    DECLARE p47 TEXT;
    DECLARE p48 TEXT;
    DECLARE p49 TEXT;
    DECLARE p50 TEXT;
    DECLARE p51 TEXT;
    DECLARE p52 TEXT;
    DECLARE p53 TEXT;
    DECLARE p54 TEXT;
    DECLARE p55 TEXT;
    DECLARE p56 TEXT;
    DECLARE p57 TEXT;
    DECLARE p58 TEXT;
    DECLARE p59 TEXT;
    DECLARE p60 TEXT;
    DECLARE p61 TEXT;
    DECLARE p62 TEXT;
    DECLARE p63 TEXT;
    DECLARE p64 TEXT;

    DECLARE p131 JSON;

    DECLARE _staff_id BIGINT;
    DECLARE _staff_name VARCHAR(200);
    DECLARE _admin_id BIGINT;

    DECLARE _customer_id BIGINT;
    DECLARE _customer_name VARCHAR(200);

    DECLARE _count INTEGER DEFAULT -1;
    DECLARE _detail JSON;
    DECLARE _item_idx BIGINT;
    DECLARE _trans_id INTEGER;
    DECLARE _quantity DECIMAL;
    DECLARE _document_form MEDIUMTEXT;
    DECLARE _item_form MEDIUMTEXT;
    DECLARE _pick_time VARCHAR(30);
    DECLARE _source_location_idx BIGINT;
    DECLARE _item_location_array VARCHAR(1000);
    DECLARE _picklist_data VARCHAR(1500);
    DECLARE _picklist_code VARCHAR(100);
    DECLARE _source_location VARCHAR(100);
    DECLARE _destination_location VARCHAR(100);
    DECLARE _item_code VARCHAR(100);
    DECLARE _collection_id BIGINT;
    DECLARE _balance NUMERIC;
    DECLARE _line_total NUMERIC;
    DECLARE _line_discount NUMERIC;
    DECLARE _stock_enabled BOOLEAN DEFAULT 1;
    DECLARE _unit_price NUMERIC;
    DECLARE _stock_name VARCHAR(200);
    DECLARE _stock_code VARCHAR(200);


    DECLARE _log_id BIGINT;

    SET group_concat_max_len = 20000000;

    SET fdata = `_data`->>'$.fdata';
    SET cardno = `_data`->>'$.cardno';
    SET version = `_data`->>'$.version';
    SET ip_address = `_data`->>'$.ip_address';
    SET txndate = `_data`->>'$.txndate';
    SET m1 = `_data`->>'$.m1';
    SET m2 = `_data`->>'$.m2';
    SET rid = `_data`->>'$.rid';
    SET p1 = `_data`->>'$.p1';
    SET p2 = `_data`->>'$.p2';
    SET p3 = `_data`->>'$.p3';
    SET p4 = `_data`->>'$.p4';
    SET p5 = `_data`->>'$.p5';
    SET p6 = `_data`->>'$.p6';
    SET p16 = `_data`->>'$.p16';
    SET p32 = `_data`->>'$.p32';
    SET p33 = `_data`->>'$.p33';
    SET p34 = `_data`->>'$.p34';
    SET p35 = `_data`->>'$.p35';
    SET p36 = `_data`->>'$.p36';
    SET p37 = `_data`->>'$.p37';
    SET p38 = `_data`->>'$.p38';
    SET p39 = `_data`->>'$.p39';
    SET p40 = `_data`->>'$.p40';
    SET p41 = `_data`->>'$.p41';
    SET p42 = `_data`->>'$.p42';
    SET p43 = `_data`->>'$.p43';
    SET p44 = `_data`->>'$.p44';
    SET p45 = `_data`->>'$.p45';
    SET p46 = `_data`->>'$.p46';
    SET p47 = `_data`->>'$.p47';
    SET p48 = `_data`->>'$.p48';
    SET p49 = `_data`->>'$.p49';
    SET p50 = `_data`->>'$.p50';
    SET p51 = `_data`->>'$.p51';
    SET p52 = `_data`->>'$.p52';
    SET p53 = `_data`->>'$.p53';
    SET p54 = `_data`->>'$.p54';
    SET p55 = `_data`->>'$.p55';
    SET p56 = `_data`->>'$.p56';
    SET p57 = `_data`->>'$.p57';
    SET p58 = `_data`->>'$.p58';
    SET p59 = `_data`->>'$.p59';
    SET p60 = `_data`->>'$.p60';
    SET p61 = `_data`->>'$.p61';
    SET p62 = `_data`->>'$.p62';
    SET p63 = `_data`->>'$.p63';
    SET p64 = `_data`->>'$.p64';
    SET p131 = `_data`->>'$.p131';


    IF (action_id = 1000000) -- build files
    THEN

      SELECT (CONCAT(
                fn_buildStockFile(), fn_buildStoreFile(), fn_buildCustomerFiles(), fn_buildFingerprintFile(),
                fn_buildSupportingFiles(), fn_buildSupplierFiles())) INTO output;


    ELSEIF (action_id = 90108) -- fingerprint registration
      THEN

        SELECT staff_id INTO _staff_id FROM staff WHERE staff_code = p48
                                                    AND status = 1;

        IF EXISTS(SELECT * FROM fingerprint WHERE staff_id = _staff_id)
        THEN
          UPDATE fingerprint
          SET template = fdata,
              type = p16,
              pin = p52,
              short_name = p49,
              pin_date = txndate
          WHERE staff_id = _staff_id;

          SET output = 'Record Updated';

        ELSE

          INSERT INTO fingerprint (staff_id,
                                   template,
                                   type,
                                   pin,
                                   pin_date,
                                   created_by,
                                   updated_dt,
                                   updated_by,
                                   short_name)
          VALUES (_staff_id, fdata, p16, p52, txndate, p50, current_timestamp, p50, p49);
          SET output = 'New record Created';
        END IF;


    ELSEIF (action_id = 90109) -- staff login
      THEN

        SELECT staff_id INTO _admin_id FROM staff WHERE staff_code = p50;

        SELECT staff_id INTO _staff_id FROM staff WHERE staff_code = p48;

        INSERT INTO attendance_log (staff_id, tmn_hw_id, tmn_time, type, admin_id)
        VALUES (_staff_id, _tmn_hw_id, txndate, 'in', _admin_id);

        SET output = 'Login logged';


    ELSEIF (action_id = 90110) -- staff logout
      THEN

        SELECT staff_id INTO _admin_id FROM staff WHERE staff_code = p50;

        SELECT staff_id INTO _staff_id FROM staff WHERE staff_code = p48;

        INSERT INTO attendance_log (staff_id, tmn_hw_id, tmn_time, type, admin_id)
        VALUES (_staff_id, _tmn_hw_id, txndate, 'out', _admin_id);

        SET output = 'Logout logged';

    ELSEIF action_id = 90103 -- cash sales
      THEN

        -- create transaction
        -- validate data::
        SELECT staff_id, staff_name INTO _staff_id, _staff_name FROM staff WHERE card_no = cardno
                                                                             AND status = 1;

        IF (COALESCE(_staff_id, 0)) = 0
        THEN
          SET output = fn_formulate_outputstring('4', 'ERROR', 'Invalid Staff', '', '', '');
          LEAVE proc;
        END IF;

        SET _detail = JSON_EXTRACT(p131, '$[0]');
        SET _trans_id = _detail->>'$.trans_id';

        INSERT INTO sales (tmn_hw_id, tmn_txn_id, staff_card, created_by, staff_id, tmn_time)
        VALUE (_tmn_hw_id, _trans_id, cardno, _staff_name, _staff_id, txndate);

        SET _log_id = LAST_INSERT_ID();

        items: LOOP
          SET _count = _count +1;
          IF _count < JSON_LENGTH(p131)
          THEN

            SET @segment = CONCAT('$[', _count, ']');
            SET _detail = JSON_EXTRACT(p131, @segment);
            SET _item_idx = _detail->>'$.item_id';
            SET _trans_id = _detail->>'$.trans_id';
            SET _line_total = _detail->>'$.total';
            SET _unit_price = _detail->>'$.selling_price';
            SET _line_discount = _detail->>'$.discount';
            SET _quantity = _detail->>'$.Qty';
            SET _item_form = REPLACE(REPLACE(_detail->>'$.reference', '&', CHAR(10)), '=', ' : ');
            SET _item_location_array = _detail->>'$.item_location_array';
            SET _picklist_data = _detail->>'$.picklist_data';

            SELECT stock_enabled, stock_name, stock_code INTO _stock_enabled, _stock_name, _stock_code
            FROM stock
            WHERE stock_id = _item_idx;

            INSERT INTO sales_detail (sales_id,
                                      tmn_hw_id,
                                      tmn_txn_id,
                                      stock_id,
                                      quantity,
                                      line_tax,
                                      line_discount,
                                      line_total,
                                      remarks,
                                      staff_id,
                                      staff_card,
                                      tmn_time,
                                      created_by,
                                      created_dt,
                                      unit_price,
                                      stock_name,
                                      stock_code)
            VALUES (_log_id,
                    _tmn_hw_id,
                    _trans_id,
                    _item_idx,
                    _quantity,
                    0,
                    _line_discount,
                    _line_total,
                    _item_form,
                    _staff_id,
                    cardno,
                    txndate,
                    _staff_name,
                    current_timestamp,
                    _unit_price,
                    _stock_name,
                    _stock_code);

            -- move stock if applies ::


            IF _stock_enabled = 1
            THEN
              SET _balance = 0;
              SELECT balance INTO _balance
              FROM stock_movement
              WHERE stock_id = _item_idx
              ORDER BY created_dt DESC
              LIMIT 1;

              SET _balance = COALESCE(_balance, 0) - ABS(_quantity);

              INSERT INTO stock_movement (stock_id,
                                          tmn_hw_id,
                                          tmn_txn_id,
                                          operation,
                                          quantity,
                                          balance,
                                          staff_id,
                                          staff_card,
                                          tmn_time,
                                          created_dt,
                                          created_by,
                                          stock_name,
                                          stock_code,
                                          remarks)
              VALUES (_item_idx,
                      _tmn_hw_id,
                      _trans_id,
                      1,
                      -_quantity,
                      _balance,
                      _staff_id,
                      cardno,
                      txndate,
                      current_timestamp,
                      _staff_name,
                      _stock_name,
                      _stock_code,
                      _item_form);

            END IF;
            ITERATE items;
          END IF;
          LEAVE items;
        END LOOP;

        SET output = fn_formulate_outputstring('2', 'SUCCESS', 'Sale logged', '', '', '');

    ELSEIF action_id = 90104 -- customer sales
      THEN

        -- create transaction
        -- validate data::
        SELECT staff_id, staff_name INTO _staff_id, _staff_name FROM staff WHERE card_no = cardno
                                                                             AND status = 1;

        SELECT customer_name INTO _customer_name FROM customer WHERE customer_id = p58;

        IF (COALESCE(_staff_id, 0)) = 0
        THEN
          SET output = fn_formulate_outputstring('4', 'ERROR', 'Invalid Staff', '', '', '');
          LEAVE proc;
        END IF;

        SET _detail = JSON_EXTRACT(p131, '$[0]');
        SET _trans_id = _detail->>'$.trans_id';

        INSERT INTO sales (tmn_hw_id,
                           tmn_txn_id,
                           staff_card,
                           created_by,
                           staff_id,
                           tmn_time,
                           customer_name,
                           customer_id)
        VALUE (_tmn_hw_id, _trans_id, cardno, _staff_name, _staff_id, txndate, _customer_name, p58);

        SET _log_id = LAST_INSERT_ID();

        items: LOOP
          SET _count = _count +1;
          IF _count < JSON_LENGTH(p131)
          THEN

            SET @segment = CONCAT('$[', _count, ']');
            SET _detail = JSON_EXTRACT(p131, @segment);
            SET _item_idx = _detail->>'$.item_id';
            SET _trans_id = _detail->>'$.trans_id';
            SET _line_total = _detail->>'$.total';
            SET _unit_price = _detail->>'$.selling_price';
            SET _line_discount = _detail->>'$.discount';
            SET _quantity = _detail->>'$.Qty';
            SET _item_form = REPLACE(REPLACE(_detail->>'$.reference', '&', CHAR(10)), '=', ' : ');
            SET _item_location_array = _detail->>'$.item_location_array';
            SET _picklist_data = _detail->>'$.picklist_data';

            SELECT stock_enabled, stock_name, stock_code INTO _stock_enabled, _stock_name, _stock_code
            FROM stock
            WHERE stock_id = _item_idx;

            INSERT INTO sales_detail (sales_id,
                                      tmn_hw_id,
                                      tmn_txn_id,
                                      stock_id,
                                      quantity,
                                      line_tax,
                                      line_discount,
                                      line_total,
                                      remarks,
                                      staff_id,
                                      staff_card,
                                      tmn_time,
                                      created_by,
                                      created_dt,
                                      unit_price,
                                      stock_name,
                                      stock_code,
                                      customer_id,
                                      customer_name)
            VALUES (_log_id,
                    _tmn_hw_id,
                    _trans_id,
                    _item_idx,
                    _quantity,
                    0,
                    _line_discount,
                    _line_total,
                    _item_form,
                    _staff_id,
                    cardno,
                    txndate,
                    _staff_name,
                    current_timestamp,
                    _unit_price,
                    _stock_name,
                    _stock_code,
                    p58,
                    _customer_name);

            -- move stock if applies ::


            IF _stock_enabled = 1
            THEN
              SET _balance = 0;
              SELECT balance INTO _balance
              FROM stock_movement
              WHERE stock_id = _item_idx
              ORDER BY created_dt DESC
              LIMIT 1;

              SET _balance = COALESCE(_balance, 0) - ABS(_quantity);

              INSERT INTO stock_movement (stock_id,
                                          tmn_hw_id,
                                          tmn_txn_id,
                                          operation,
                                          quantity,
                                          balance,
                                          staff_id,
                                          staff_card,
                                          tmn_time,
                                          created_dt,
                                          created_by,
                                          stock_name,
                                          stock_code,
                                          remarks)
              VALUES (_item_idx,
                      _tmn_hw_id,
                      _trans_id,
                      1,
                      -_quantity,
                      _balance,
                      _staff_id,
                      cardno,
                      txndate,
                      current_timestamp,
                      _staff_name,
                      _stock_name,
                      _stock_code,
                      _item_form);

            END IF;
            ITERATE items;
          END IF;
          LEAVE items;
        END LOOP;

        SET output = fn_formulate_outputstring('2', 'SUCCESS', 'Customer Sale logged', '', '', '');

    ELSEIF action_id = 90111 -- check customer loyalty points
      THEN
        SELECT customer_name INTO _customer_name
        FROM customer
        WHERE card_no = p1;

        SET output = fn_formulate_outputstring('2', 'POINTS CHECK', _customer_name, '120,000 Points', '', '');

    ELSE


      SET output = fn_formulate_outputstring('4', 'ERROR', 'Invalid Action', '', '', '');

    END IF;


  END
;

