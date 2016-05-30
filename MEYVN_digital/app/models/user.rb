class User < ApplicationRecord
  # Include default devise modules. Others available are:
  # :confirmable, :lockable, :timeoutable and :omniauthable
  has_many :comments
  has_many :saved_filters, foreign_key: 'user_id', class_name: 'Filter'

  devise :database_authenticatable, :registerable,
         :recoverable, :rememberable, :trackable,
         :validatable, :trackable, :validatable
  validates :name, presence: true
end
