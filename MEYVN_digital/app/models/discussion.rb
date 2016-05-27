class Discussion < ApplicationRecord
  belongs_to :event
  has_many :comments

  validates :topic, presence: true
end
