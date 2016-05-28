class User < ApplicationRecord
  has_many :comments
  has_many :saved_filters, foreign_key: 'user_id', class_name: 'Filter'

  validates :name, presence: true
end
