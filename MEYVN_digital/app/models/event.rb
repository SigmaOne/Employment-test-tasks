class Event < ApplicationRecord
  belongs_to :city
  has_many :discussions

  validates :name, presence: true
  validates :start_date, presence: true
end
