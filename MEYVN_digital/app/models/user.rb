class User < ApplicationRecord
  has_many :comments
  has_many :saved_filters, foreign_key: 'filter_id', class_name: 'Filter'
end
