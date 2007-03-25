-- изменение структуры
ALTER TABLE `manufacturers` ADD `type` ENUM( 'tyres', 'disks', 'both' ) DEFAULT 'both' NOT NULL AFTER `name` 

-- Смена типов таблиц
ALTER TABLE `disk_models` TYPE = INNODB
ALTER TABLE `disks` TYPE = INNODB
ALTER TABLE `tyre_models` TYPE = INNODB
ALTER TABLE `tyres` TYPE = INNODB
ALTER TABLE `manufacturers` TYPE = INNODB

-- 
-- Constraints for dumped tables
-- 

-- 
-- Constraints for table `disk_models`
-- 
ALTER TABLE `disk_models`
  ADD CONSTRAINT `disk_models_ibfk_1` FOREIGN KEY (`manufacturer`) REFERENCES `manufacturers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Constraints for table `disks`
-- 
ALTER TABLE `disks`
  ADD CONSTRAINT `disks_ibfk_1` FOREIGN KEY (`model`) REFERENCES `disk_models` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Constraints for table `tyre_models`
-- 
ALTER TABLE `tyre_models`
  ADD CONSTRAINT `tyre_models_ibfk_1` FOREIGN KEY (`manufacturer`) REFERENCES `manufacturers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

-- 
-- Constraints for table `tyres`
-- 
ALTER TABLE `tyres`
  ADD CONSTRAINT `tyres_ibfk_1` FOREIGN KEY (`model`) REFERENCES `tyre_models` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;