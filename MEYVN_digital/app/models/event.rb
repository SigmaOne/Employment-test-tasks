class Event < ApplicationRecord
  belongs_to :city

  validates :name, presence: true
  validates :start_date, presence: true
end
